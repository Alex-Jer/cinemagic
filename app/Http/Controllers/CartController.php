<?php

namespace App\Http\Controllers;

use App\Models\Screening;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index')
            ->with('cart', session('cart') ?? []);
    }

    public function store(Screening $screening)
    {
        $cart = session('cart') ?? collect();
        $cart->put($screening->id, $screening);
        session()->put('cart', $cart);

        return back();
    }

    public function destroy(Screening $screening)
    {
        $cart = session('cart') ?? collect();
        $cart->pull($screening->id);
        session()->put('cart', $cart);

        return back();
    }
}
