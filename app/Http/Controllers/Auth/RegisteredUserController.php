<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }


    /**
     * Display the user profile view.
     *
     * @return void
     */
    public function index()
    {
        $cliente = Cliente::find(auth()->user()->id);
        $tiposPagamento = Cliente::pluck('tipo_pagamento')->unique()->filter()->toArray();
        return view('profile', compact(['cliente', 'tiposPagamento']));
    }


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'     => ['string', 'max:255', 'nullable'],
            'email'    => ['string', 'email', 'max:255', 'nullable', 'unique:users'],
            'nif'      => ['numeric', 'integer', 'min:9', 'max:9', 'nullable'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // dd($request->all());

        $user = User::find(Auth::user()->id);
        $cliente = Cliente::find(Auth::user()->id);

        if ($request->name)
            $user->name = $request->name;

        if ($request->email)
            $user->email = $request->email;

        // $user->password = Hash::make($request->password);

        if ($request->nif)
            $cliente->nif = $request->nif;

        $user->save();
        $cliente->save();

        return redirect()->back();
    }
}
