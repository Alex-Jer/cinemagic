<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Response;
use Storage;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipts = Auth::user()->customer->receipts()->paginate(12);
        return view('receipts.index', compact('receipts'));
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
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        return view('receipts.show', compact('receipt'));
    }

    public function get_pdf(Receipt $receipt)
    {
        if (!(isset($receipt->recibo_pdf_url) && $receipt->recibo_pdf_url != null && File::exists("storage/" . $receipt->recibo_pdf_url))) {
            if (!TicketController::generate_pdf($receipt)) {
                return redirect()->back()->withErrors(['no_receipt_pdf' => 'Não foi possível gerar um PDF para esse recibo.']);
            }
        }
        return Response::download("storage/" . $receipt->recibo_pdf_url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
