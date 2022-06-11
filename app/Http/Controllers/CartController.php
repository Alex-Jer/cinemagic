<?php

namespace App\Http\Controllers;

use App\Models\Film;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index')
            ->with('cart', session('cart') ?? []);
    }

    public function add(Film $film)
    {
        $cart = session('cart') ?? collect();
        $cart->put($film->id, $film);
        session()->put('cart', $cart);

        return back();
    }

    public function remove(Film $film)
    {
        $cart = session('cart') ?? collect();
        $cart->pull($film->id);
        session()->put('cart', $cart);

        return back();
    }
}
