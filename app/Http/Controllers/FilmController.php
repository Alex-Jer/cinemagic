<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectedGenre = $request->genre_code ?? '';
        $search = $request->search ?? '';

        $query = Film::query();

        if ($selectedGenre) {
            $query->whereHas('genre', function ($query) use ($selectedGenre) {
                $query->where('genero_code', $selectedGenre);
            });
        }

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('titulo', 'like', "%$search%")
                    ->orWhere('sumario', 'like', "%$search%");
            });
        }

        $films = $query->with('screenings')->orderBy('titulo')
            ->whereHas('screenings', function ($query) {
                $query->where('data', '>', now()->format('Y-m-d'))
                    ->orWhere(function ($query) {
                        $query->where('data', now()->format('Y-m-d'))
                            ->where('horario_inicio', '>=', now()->subMinutes(5)->format('H:i'));
                    });
            })->paginate(25);

        $genres = Genre::whereHas('films', function ($query) {
            $query->whereHas('screenings', function ($query) {
                $query->where('data', '>', now()->format('Y-m-d'))
                    ->orWhere(function ($query) {
                        $query->where('data', now()->format('Y-m-d'))
                            ->where('horario_inicio', '>=', now()->subMinutes(5)->format('H:i'));
                    });
            });
        })->get();

        return view('films.index', compact(['films', 'genres', 'selectedGenre', 'search']));
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
        $film->screenings = $film->screenings->load('screen')
            ->filter(function ($screening) {
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

    public function admin_index()
    {
        return view('admin.films.index');
    }
}
