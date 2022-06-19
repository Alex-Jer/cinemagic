<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreenPostRequest;
use App\Models\Screen;

class ScreenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screens = Screen::with('seats')->orderBy('nome')->paginate(9);
        return view('admin.screens.index', compact('screens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.screens.createOrEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScreenPostRequest $request)
    {
        $validated = $request->validated();

        $screen = new Screen;
        $screen->nome = $validated['nome'];
        $screen->save();

        $seats = [];
        $alphabet = range('A', 'Z');

        for ($i = 0; $i < $validated['filas']; $i++) {
            for ($j = 0; $j < $validated['posicoes']; $j++) {
                $seats[] = [
                    'fila' => $alphabet[$i],
                    'posicao' => $j + 1,
                    'sala_id' => $screen->id,
                ];
            }
        }

        $screen->seats()->createMany($seats);

        return redirect()->route('admin.screens.index')
            ->with('alert-msg', 'Sala ' . $screen->nome . ' criada com sucesso!')
            ->with('alert-color', 'green')
            ->with('alert-icon', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Screen  $screen
     * @return \Illuminate\Http\Response
     */
    public function show(Screen $screen)
    {
        return view('admin.screens.show', compact('screen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Screen  $screen
     * @return \Illuminate\Http\Response
     */
    public function edit(Screen $screen)
    {
        $filas = $screen->seats->groupBy('fila')->count();
        $posicoes = $screen->seats->groupBy('posicao')->count();
        $screen = Screen::find($screen->id);

        return view('admin.screens.createOrEdit', compact('screen', 'filas', 'posicoes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScreenPostRequest $request, Screen $screen)
    {
        $validated = $request->validated();

        $screen->nome = $validated['nome'];

        $seats = [];
        $alphabet = range('A', 'Z');
        for ($i = 0; $i < $validated['filas']; $i++) {
            for ($j = 0; $j < $validated['posicoes']; $j++) {
                $seats[] = [
                    'fila' => $alphabet[$i],
                    'posicao' => $j + 1,
                    'sala_id' => $screen->id,
                ];
            }
        }

        try {
            $screen->seats()->delete();
        } catch (\Throwable $th) {
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.screens.index')
                    ->with('alert-msg', 'Não foi possível editar a sala ' . $screen->nome . ' porque esta sala tem bilhetes associados!')
                    ->with('alert-color', 'red')
                    ->with('alert-icon', 'error');
            } else {
                return redirect()->route('admin.screens.index')
                    ->with('alert-msg', 'Não foi possível editar a sala ' . $screen->nome . '. Erro: ' . $th->errorInfo[2])
                    ->with('alert-color', 'red')
                    ->with('alert-icon', 'error');
            }
        }

        $screen->seats()->createMany($seats);

        $screen->save();

        return redirect()->route('admin.screens.index')
            ->with('alert-msg', 'Sala ' . $screen->nome . ' editada com sucesso.')
            ->with('alert-color', 'green')
            ->with('alert-icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screen  $screen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Screen $screen)
    {
        try {
            $screen->seats()->delete();
            $screen->delete();
            Screen::destroy($screen->id);
            return redirect()->route('admin.screens.index')
                ->with('alert-msg', 'Sala ' . $screen->nome . ' apagada com sucesso.')
                ->with('alert-color', 'green')
                ->with('alert-icon', 'success');
        } catch (\Throwable $th) {
            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.screens.index')
                    ->with('alert-msg', 'Não foi possível apagar a sala ' . $screen->nome . ' porque esta sala tem bilhetes associados!')
                    ->with('alert-color', 'red')
                    ->with('alert-icon', 'error');
            } else {
                return redirect()->route('admin.screens.index')
                    ->with('alert-msg', 'Não foi possível apagar a sala ' . $screen->nome . '. Erro: ' . $th->errorInfo[2])
                    ->with('alert-color', 'red')
                    ->with('alert-icon', 'error');
            }
        }
    }
}
