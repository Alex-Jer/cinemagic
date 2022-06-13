<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index')
            ->with('cart', session('cart') ?? []);
    }

    public function store(Screening $screening, Seat $seat)
    {
        $cart = session('cart') ?? collect();
        $cart[] = [
            'screening' => $screening,
            'seat' => $seat,
        ];
        session()->put('cart', $cart);

        return back();
    }

    public function destroy($key)
    {
        $cart = session('cart') ?? collect();
        unset($cart[$key]);

        // $cart->pull($screening->id);
        // session()->put('cart', $cart);

        return back();
    }
}
