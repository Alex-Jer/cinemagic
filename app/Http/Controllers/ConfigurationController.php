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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'preco_bilhete_sem_iva' => 'nullable|numeric',
            'percentagem_iva' => 'nullable|numeric',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $configuration = Configuration::first();

        if ($request->preco_bilhete_sem_iva)
            $configuration->preco_bilhete_sem_iva = $request->preco_bilhete_sem_iva;
        if ($request->percentagem_iva)
            $configuration->percentagem_iva = $request->percentagem_iva;
        $configuration->save();

        return redirect()->route('admin.config.index')
            ->with('alert-icon', 'success')
            ->with('alert-color', 'green')
            ->with('alert-msg', 'Configurações atualizadas com sucesso.');
    }
}
