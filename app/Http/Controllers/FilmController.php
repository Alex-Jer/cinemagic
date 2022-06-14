<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Debugbar;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::orderBy('titulo')
            ->whereHas('screenings', function ($query) {
                $query->where('data', '>', now()->format('Y-m-d'))
                    ->orWhere(function ($query) {
                        $query->where('data', now()->format('Y-m-d'))
                            ->where('horario_inicio', '>=', now()->subMinutes(5)->format('H:i'));
                    });
            })->paginate(25);

        return view('films.index', compact('films'));
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
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        $film->screenings = $film->screenings->filter(function ($screening) {
            return $screening->data > now() ||
                ($screening->data->format('d/m/Y') == now()->format('d/m/Y')
                    && $screening->horario_inicio->format('H:i') >= now()->subMinutes(5)->format('H:i')
                );
        });

        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        //
    }
}
