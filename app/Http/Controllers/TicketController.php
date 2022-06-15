<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Receipt;
use App\Models\Screening;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Services\Payment;
use Auth;
use Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Screening $screening)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $config = Configuration::first();
        $priceTotal = $config->preco_bilhete_sem_iva * session('cart')->count();
        $priceTotalTax = (round($config->preco_bilhete_sem_iva + ($config->preco_bilhete_sem_iva * $config->percentagem_iva) / 100, 2)) * 3;

        $attributes = [
            'customer_id' => Auth::user()->id,
            'date' => date('Y-m-d'),
            'total_wo_tax' => $priceTotal,
            'tax' => $config->percentagem_iva,
            'total_w_tax' => $priceTotalTax,
            'nif' => Auth::user()->customer->nif,
            'customer_name' => Auth::user()->name,
            'payment_type' => Auth::user()->customer->tipo_pagamento,
            'payment_ref' => Auth::user()->customer->ref_pagamento,
        ];

        $validator = Validator::make($attributes, [
            'customer_id' => 'required',
            'date' => 'required',
            'total_wo_tax' => 'required',
            'tax' => 'required',
            'total_w_tax' => 'required',
            'nif' => 'nullable',
            'customer_name' => 'required',
            'payment_type' => 'required',
            'payment_ref' => 'required',
        ]);

        switch (Auth::user()->customer->tipo_pagamento) {
            case 'Visa':
                if (!Payment::payWithVisa($validator->getData()['payment_ref'], 257))
                    return redirect()->back()->with('error', 'Pagamento inválido');
                break;
            case 'PayPal':
                if (Payment::payWithPaypal($validator->getData()['payment_ref']))
                    return redirect()->back()->with('error', 'Pagamento inválido');
                break;
            default:
                if (Payment::payWithMBWay($validator->getData()['payment_ref']))
                    return redirect()->back()->with('error', 'Pagamento inválido');
                break;
        }

        $newReceipt = new Receipt;
        $newReceipt->cliente_id = Auth::user()->id;
        $newReceipt->data = date('Y-m-d');
        $newReceipt->preco_total_sem_iva = $priceTotal;
        $newReceipt->iva = $config->percentagem_iva;
        $newReceipt->preco_total_com_iva = $priceTotalTax;
        $newReceipt->nif = Auth::user()->customer->nif;
        $newReceipt->nome_cliente = Auth::user()->name;
        $newReceipt->tipo_pagamento = Auth::user()->customer->tipo_pagamento;
        $newReceipt->ref_pagamento = Auth::user()->customer->ref_pagamento;
        $newReceipt->save();

        foreach (session('cart') as $cartTicket) {

            $attributes = [
                'receipt_id' => $newReceipt->id,
                'customer_id' => Auth::user()->id,
                'screening_id' => $cartTicket['screening']->id,
                'seat' => $cartTicket['seat']->id,
                'price_wo_tax' => $config->preco_bilhete_sem_iva,
            ];

            $validator = Validator::make($attributes, [
                'receipt_id' => 'required',
                'customer_id' => 'required',
                'screening_id' => 'required',
                'seat' => 'required',
                'price_wo_tax' => 'required',
            ]);

            if ($validator->fails())
                return back()->withErrors($validator);

            $newTicket = new Ticket;
            $newTicket->recibo_id = $newReceipt->id;
            $newTicket->cliente_id = Auth::user()->id;
            $newTicket->sessao_id = $cartTicket['screening']->id;
            $newTicket->lugar_id = $cartTicket['seat']->id;
            $newTicket->preco_sem_iva = $config->preco_bilhete_sem_iva;
            $newTicket->save();
        }

        session()->forget('cart');

        // return redirect()
        //     ->route('receipt.show', $newReceipt->id)
        //     ->with('success', 'Pagamento efectuado com sucesso');
    }

    public function add(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
