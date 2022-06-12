<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $mode)
    {
        $customer = Customer::find($user->id);
        $paymentTypes = Customer::distinct()->whereNotNull('tipo_pagamento')->pluck('tipo_pagamento')->toArray();

        return view('admin.users.view', compact('user', 'customer', 'paymentTypes', 'mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return back(); //TODO
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            dd($th);
            return back()
                ->with('alert-msg', 'Não foi possível apagar o Utilizador "' . $oldName . '".')
                ->with('alert-color', 'red')
                ->with('alert-icon', 'error');
        }
    }
}
