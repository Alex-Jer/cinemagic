<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisteredUserController;
use Debugbar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = User::find(Auth::user()->id);
        $tipos = $authUser->tipo == 'A' ? ['A', 'F', 'C'] : ['C'];
        $users = User::orderBy('name')->whereIn('tipo', $tipos)->paginate(10);
        return view('admin.users.index', compact('users', 'authUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = $request->tipo_utilizador;

        if ($tipo != 'A' && $tipo != 'F') {
            return abort(403, "Acesso proibido"); // em inglês para copiar a do laravel
        }

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'tipo'     => $request->tipo_utilizador,
        ]);

        event(new Registered($user));

        if ($request->hasFile('profile_pic')) {
            $user->foto_url ? Storage::delete('public/fotos/' . $user->foto_url) : null;
            $path = $request->profile_pic->store('public/fotos');
            $user->foto_url = basename($path);
            $user->save();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $customer = Customer::find($user->id);
        $mode = 'view';
        return view('admin.users.view', compact('user', 'customer', 'mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $customer = Customer::find($user->id);
        $paymentTypes = Customer::distinct()->whereNotNull('tipo_pagamento')->pluck('tipo_pagamento')->toArray();
        $mode = 'edit';
        return view('admin.users.view', compact('user', 'customer', 'paymentTypes', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPostRequest $request, User $user)
    {
        $validated = $request->validated();

        $user = User::find($user->id);
        $customer = Customer::find($user->id);

        if ($request->name)
            $user->name = $validated['name'];

        if ($request->email) {
            $user->email = $validated['email'];
            $user->sendEmailVerificationNotification();
            $user->email_verified_at = null;
        }

        if ($request->hasFile('profile_pic')) {
            $user->foto_url ? Storage::delete('public/fotos/' . $user->foto_url) : null;
            $path = $request->profile_pic->store('public/fotos');
            $user->foto_url = basename($path);
        }

        if ($user->tipo === 'C')
            RegisteredUserController::validateCustomer($request, $customer, $validated);

        $user->save();

        return back();
    }

    public function toggleblock(User $user)
    {
        $user->bloqueado = !$user->bloqueado;
        $user->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == auth()->user()->id) {
            return back()
                ->with('alert-msg', 'Não podes apagar a tua própia conta tolinho!')
                ->with('alert-color', 'red')
                ->with('alert-icon', 'error');
        }

        $oldName = $user->name;
        //$oldUrlFoto = $user->foto_url;
        try {

            $user->delete();
            /*if ($oldUrlFoto != null) {
                Storage::delete('public/fotos/' . $oldUrlFoto);
            }*/

            return back()
                ->with('alert-msg', 'Utilizador "' . $oldName . '" removido com sucesso.')
                ->with('alert-color', 'green')
                ->with('alert-icon', 'success');
        } catch (\Throwable $th) {
            return back()
                ->with('alert-msg', 'Não foi possível apagar o Utilizador "' . $oldName . '".')
                ->with('alert-color', 'red')
                ->with('alert-icon', 'error');
        }
    }
}
