<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\Seat;

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

        // If a seat is already in the cart, remove it (works like a toggle)
        if ($cart->where('seat', $seat)->count() > 0) {
            $key = $cart->where('seat', $seat)->keys()->first();
            $this->destroy($key);
            return back();
        }

        // If a seat is already occupied, don't add it to the cart and redirect back with an error
        if ($seat->isOccupied($screening->id))
            return back()->withErrors(['seat' => 'Este lugar já se encontra ocupado']);

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

        return back();
    }
}
