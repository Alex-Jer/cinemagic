<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmPostRequest;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Storage;

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
        $genres = Genre::all();
        return view('admin.films.createOrEdit', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmPostRequest $request)
    {
        $validated = $request->validated();
        $film = new Film;
        $film->titulo = $validated['titulo'];
        $film->genero_code = $validated['genero_code'];
        $film->ano = $validated['ano'];
        $film->sumario = $validated['sumario'];
        $film->trailer_url = $validated['trailer_url'];

        if ($request->hasFile('cartaz')) {
            $path = $request->cartaz->store('public/cartazes');
            $film->cartaz_url = basename($path);
        }

        $film->save();

        return redirect()->route('admin.films.index')
            ->with('alert-msg', 'Filme "' . $film->titulo . '" adicionado com sucesso.')
            ->with('alert-color', 'green')
            ->with('alert-icon', 'success');
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
        $film = Film::find($film->id);
        $genres = Genre::all();
        return view('admin.films.createOrEdit', compact('film', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(FilmPostRequest $request, Film $film)
    {
        $validated = $request->validated();
        $film->fill($validated);

        if ($request->hasFile('cartaz')) {
            Storage::delete('public/cartazes/' . $film->cartaz_url);
            $path = $request->cartaz->store('public/cartazes');
            $film->cartaz_url = basename($path);
        }

        $film->save();

        return redirect()->route('admin.films.index')
            ->with('alert-msg', 'Filme "' . $film->titulo . '" alterado com sucesso.')
            ->with('alert-color', 'green')
            ->with('alert-icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $oldName = $film->titulo;
        $oldId = $film->id;
        $oldPosterUrl = $film->cartaz_url;

        try {
            $film->delete();
            Film::destroy($oldId);
            Storage::delete('public/cartazes/' . $oldPosterUrl);
            return redirect()->route('admin.films.index')
                ->with('alert-msg', 'Filme "' . $film->titulo . '" apagado com sucesso.')
                ->with('alert-color', 'green')
                ->with('alert-icon', 'success');
        } catch (\Throwable $th) {
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.films.index')
                    ->with('alert-msg', 'Não foi possível apagar o filme "' . $oldName . '", porque este filme tem sessões associadas!')
                    ->with('alert-color', 'red')
                    ->with('alert-icon', 'error');
            } else {
                return redirect()->route('admin.films.index')
                    ->with('alert-msg', 'Não foi possível apagar o filme "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-color', 'red')
                    ->with('alert-icon', 'error');
            }
        }
    }

    public function admin_index(Request $request)
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

        $genres = Genre::all();

        $films = $query->with('screenings')->orderBy('ano', 'desc')->paginate(12);

        return view('admin.films.index', compact(['films', 'selectedGenre', 'search', 'genres']));
    }
}
