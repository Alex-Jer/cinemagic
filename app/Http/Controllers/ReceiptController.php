<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use File;
use Illuminate\Support\Facades\Auth;
use Response;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipts = Auth::user()->customer->receipts()->paginate(11);
        return view('receipts.index', compact('receipts'));
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
}
