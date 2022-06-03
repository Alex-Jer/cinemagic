<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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
     * @param   \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'tipo'     => 'C',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'nullable'],
            'email' => ['string', 'email', 'max:255', 'nullable', 'unique:users'],
            'nif' => ['min:9', 'max:9', 'nullable'],
            'tipo_pagamento' => [Rule::in(['PayPal', 'MBWay', 'Visa']), 'nullable'],
            'ref_pagamento' => ['nullable'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // dd($request->all());

        $user = User::find(Auth::user()->id);
        $cliente = Cliente::find(Auth::user()->id);

        if ($request->name)
            $user->name = $request->name;

        if ($request->email)
            $user->email = $request->email;

        if ($request->nif)
            $cliente->nif = $request->nif;

        if ($request->tipo_pagamento)
            $cliente->tipo_pagamento = $request->tipo_pagamento;

        //********
        if (!$request->ref_pagamento)
            $request->ref_pagamento = $cliente->ref_pagamento;

        if (!$request->tipo_pagamento)
            $request->tipo_pagamento = $cliente->tipo_pagamento;
        //********

        // dd(['ref' => $request->ref_pagamento, 'tipo' => $request->tipo_pagamento]);

        if ($request->ref_pagamento) {
            switch ($request->tipo_pagamento) {
                case 'Visa':
                    if (Str::length($request->ref_pagamento) !== 16)
                        return redirect()->back()->withErrors(['ref_pagamento' => 'Referência Visa inválida']);
                    break;
                case 'PayPal':
                    if (!filter_var($request->ref_pagamento, FILTER_VALIDATE_EMAIL))
                        return redirect()->back()->withErrors(['ref_pagamento' => 'Referência PayPal inválida']);
                default:
                    if (Str::length($request->ref_pagamento) !== 9 || !Str::startsWith($request->ref_pagamento, '9'))
                        return redirect()->back()->withErrors(['ref_pagamento' => 'Referência MBWay inválida']);
                    break;
            }
            $cliente->ref_pagamento = $request->ref_pagamento;
        }

        // $user->password = Hash::make($request->password);
        $user->save();
        $cliente->save();

        return redirect()->back();
    }
}
