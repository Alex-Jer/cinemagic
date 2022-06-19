<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreeningPostRequest;
use App\Models\Configuration;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Screen;
use App\Models\Screening;
use Auth;
use Illuminate\Http\Request;
use Str;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->date ?? '';
        $search = $request->search ?? '';

        $query = Screening::query();

        if ($date) {
            $query->where('data', $date);
        }

        if ($search) {
            $asearch = Str::replace(" ", "%", $search);
            $query->whereHas('film', function ($query) use ($asearch) {
                $query->where('titulo', 'like', "%$asearch%");
            });
        }

        $screenings = $query->orderBy('data', 'desc')->orderBy('horario_inicio', 'desc')->paginate(12);

        return view('admin.screenings.index', compact(['screenings', 'search', 'date']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Film $film)
    {
        $film = Film::find($film->id);
        $genres = Genre::all();
        $screens = Screen::all();
        return view('admin.films.createOrEdit', compact('film', 'genres', 'screens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScreeningPostRequest $request)
    {
        $validated = $request->validated();

        $screening = new Screening;
        $screening->fill($validated);

        $screening->save();

        return redirect()->back()
            ->with('alert-msg', 'Sessão criada para o dia ' . $screening->data->format('d/m/Y') . ' às ' . $screening->horario_inicio->format('H:i') . '.')
            ->with('alert-color', 'green')
            ->with('alert-icon', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function show(Screening $screening)
    {
        if (Auth::check()) {
            if (!$this->authorize('buy', $screening))
                return abort(403);
        }

        $screen = $screening->screen;
        $seats = $screen->seats;

        $occupied = cache()->remember('occupied_seats' . $screening->id, 30, function () use ($screening) {
            return $screening->tickets->count();
        });

        return view('screenings.show', compact('screening', 'seats', 'occupied'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function edit(Screening $screening)
    {
        $screening = Screening::find($screening->id);
        return view('admin.screenings.edit', compact('screening'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function update(ScreeningPostRequest $request, Screening $screening)
    {
        $validated = $request->validated();
        $screening->fill($validated);

        $screening->save();

        return redirect()->route('admin.screenings.index')
            ->with('alert-msg', 'Sessão para o dia ' . $screening->data->format('d/m/Y') . ' às ' . $screening->horario_inicio->format('H:i') . ' editada com sucesso.')
            ->with('alert-color', 'green')
            ->with('alert-icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Screening $screening)
    {
        try {
            $screening->delete();
            Screening::destroy($screening->id);
            return redirect()->route('admin.screenings.index')
                ->with('alert-msg', 'Sessão "' . $screening->id . '" apagada com sucesso.')
                ->with('alert-color', 'green')
                ->with('alert-icon', 'success');
        } catch (\Throwable $th) {
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                //just in case because policies already prevent this
                return redirect()->route('admin.screenings.index')
                    ->with('alert-msg', 'Não foi possível apagar a sessão #' . $screening->id . ', porque esta sessão tem bilhetes associados!')
                    ->with('alert-color', 'red')
                    ->with('alert-icon', 'error');
            } else {
                return redirect()->route('admin.screenings.index')
                    ->with('alert-msg', 'Não foi possível apagar a sessão #' . $screening->id . '. Erro: ' . $th->errorInfo[2])
                    ->with('alert-color', 'red')
                    ->with('alert-icon', 'error');
            }
        }
    }

    public function employee_index(Request $request)
    {
        $date = $request->date ?? '';
        $search = $request->search ?? '';

        $query = Screening::query();

        if ($date) {
            $query->where('data', $date);
        }

        if ($search) {
            $asearch = Str::replace(" ", "%", $search);
            $query->whereHas('film', function ($query) use ($asearch) {
                $query->where('titulo', 'like', "%$asearch%");
            });
        }

        $query->where('data', now()->format('Y-m-d'))
            ->where('horario_inicio', '>=', now()->subHours(2)->format('H:i'))  //pode entrar quando quiser até ao fim do filme (2 horas)
            ->where('horario_inicio', '<', now()->addMinutes(15)->format('H:i')); //pode entrar na sessão apenas 15 minutos antes do início da mesma

        $screenings = $query->orderBy('data', 'desc')->orderBy('horario_inicio', 'desc')->paginate(12);

        return view('admin.screenings.index', compact(['screenings', 'search', 'date']));
    }

    public function backend_show(Screening $screening)
    {
        $seats = $screening->screen->seats;

        $occupied = cache()->remember('occupied_seats' . $screening->id, 30, function () use ($screening) {
            return $screening->tickets->count();
        });

        return view('admin.screenings.show', compact('screening', 'seats', 'occupied'));
    }
}
