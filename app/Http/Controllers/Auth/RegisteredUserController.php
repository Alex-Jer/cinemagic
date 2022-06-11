<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Models\Customer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
        $customer = Customer::find(auth()->user()->id);
        $paymentTypes = Customer::distinct()->select('tipo_pagamento')->pluck('tipo_pagamento')->toArray();

        return view('profile', compact('customer', 'paymentTypes'));
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

    public function update(UserPostRequest $request)
    {
        $validated = $request->validated();

        $user = User::find(Auth::user()->id);
        $customer = Customer::find(Auth::user()->id);

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
            $this->validateCustomer($request, $customer, $validated);

        // $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back();
    }

    // generate private method to validate customer

    private function validateCustomer(UserPostRequest $request, Customer $customer, mixed $validated)
    {
        if ($request->nif)
            $customer->nif = $validated['nif'];

        if ($request->tipo_pagamento)
            $customer->tipo_pagamento = $validated['tipo_pagamento'];
        else
            $validated['tipo_pagamento'] = $customer->tipo_pagamento;

        if (!$request->ref_pagamento)
            $request->ref_pagamento = $customer->ref_pagamento;

        switch ($validated['tipo_pagamento']) {
            case 'Visa':
                if (Str::length($request->ref_pagamento) !== 16)
                    return redirect()->back()->withErrors(['ref_pagamento' => 'Referência Visa inválida']);
                break;
            case 'PayPal':
                if (!filter_var($request->ref_pagamento, FILTER_VALIDATE_EMAIL))
                    return redirect()->back()->withErrors(['ref_pagamento' => 'Referência PayPal inválida']);
                break;
            default:
                if (Str::length($request->ref_pagamento) !== 9 || !Str::startsWith($request->ref_pagamento, '9'))
                    return redirect()->back()->withErrors(['ref_pagamento' => 'Referência MBWay inválida']);
                break;
        }

        $customer->ref_pagamento = $request->ref_pagamento;
        $customer->save();
    }
}
