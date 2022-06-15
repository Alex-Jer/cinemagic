<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Validator;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Configuration::first();
        return view('admin.config.index', compact('config'));
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
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuration $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'preco_bilhete_sem_iva' => 'nullable|numeric',
            'percentagem_iva' => 'nullable|numeric',
        ]);

        //TODO: Não funciona?
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $configuration = Configuration::first();

        if ($request->preco_bilhete_sem_iva)
            $configuration->preco_bilhete_sem_iva = $request->preco_bilhete_sem_iva;
        if ($request->percentagem_iva)
            $configuration->percentagem_iva = $request->percentagem_iva;
        $configuration->save();

        return redirect()->route('admin.config.index')
            ->with('alert-type', 'success')
            ->with('alert-color', 'green')
            ->with('alert-msg', 'Configurações atualizadas com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        //
    }
}
