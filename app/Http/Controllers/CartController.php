<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return view('cart.index')
            ->with('cart', session('cart') ?? []);
    }

    public function add(Request $request, Film $film)
    {
        $cart = session('cart') ?? [];

        $cart[$film->id] = [
            'id' => $film->id,
            'titulo' => $film->titulo,
            'genero_code' => $film->genero_code,
            'ano' => $film->ano,
            'cartaz_url' => $film->cartaz_url,
            'sumario' => $film->sumario,
            'trailer_url' => $film->trailer_url,
            'custom' => $film->custom,
        ];

        $request->session()->put('cart', $cart);

        return back();
    }
}
