<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // foreach (session('cart') as $film) {
        //     dump($film->titulo);
        //     dump('id: ' . $film->id);
        // }
        // die();
        return view('cart.index')
            ->with('cart', session('cart'));
    }

    public function add(Request $request, Film $film)
    {
        $cart = session('cart') ?? collect();

        $cart->push($film);

        session()->put('cart', $cart);

        return back();
    }
}
