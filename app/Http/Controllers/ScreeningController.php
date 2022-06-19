<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
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
            $search = Str::replace(" ", "%", $search);
            $query->whereHas('film', function ($query) use ($search) {
                $query->where('titulo', 'like', "%$search%");
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Screening $screening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Screening $screening)
    {
        //
    }

    public function employee_index()
    {
        return view('employee.screenings.index');
    }

    public function admin_show(Screening $screening)
    {
        $seats = $screening->screen->seats;

        $occupied = cache()->remember('occupied_seats' . $screening->id, 30, function () use ($screening) {
            return $screening->tickets->count();
        });

        return view('admin.screenings.show', compact('screening', 'seats', 'occupied'));
    }
}
