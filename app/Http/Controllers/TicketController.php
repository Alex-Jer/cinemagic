<?php

namespace App\Http\Controllers;

use App\Mail\TicketsPurchased;
use App\Models\Configuration;
use App\Models\Receipt;
use App\Models\Screening;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Services\Payment;
use Auth;
use Debugbar;
use Mail;
use PDF;
use QrCode;
use Response;
use Storage;
use URL;
use Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::with('receipt', 'seat', 'screening')
            ->where('cliente_id', Auth::user()->customer->id)
            ->orderBy('created_at', 'desc')->paginate(11);
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $config = Configuration::first();
        $totalPrice = $config->preco_bilhete_sem_iva * session('cart')->count();
        $totalPriceTax = (round($config->preco_bilhete_sem_iva + ($config->preco_bilhete_sem_iva * $config->percentagem_iva) / 100, 2)) * session('cart')->count();

        $receiptAttr = [
            'customer_id' => Auth::user()->id,
            'date' => date('Y-m-d'),
            'total_wo_tax' => $totalPrice,
            'tax' => $config->percentagem_iva,
            'total_w_tax' => $totalPriceTax,
            'nif' => Auth::user()->customer->nif,
            'customer_name' => Auth::user()->name,
            'payment_type' => Auth::user()->customer->tipo_pagamento,
            'payment_ref' => Auth::user()->customer->ref_pagamento,
        ];

        $validator = Validator::make($receiptAttr, [
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

        if ($validator->fails())
            return back()->withErrors($validator);

        $validated = $validator->validate();

        switch ($validated['payment_type']) {
            case 'Visa':
                // Exemplo
                if (!Payment::payWithVisa($validated['payment_ref'], 257))
                    return redirect()->back()->with('error', 'Pagamento inválido');
                break;
            case 'PayPal':
                if (!Payment::payWithPaypal($validated['payment_ref'])) {
                    return redirect()->back()->with('error', 'Pagamento inválido');
                }
                break;
            default:
                if (!Payment::payWithMBWay($validated['payment_ref']))
                    return redirect()->back()->with('error', 'Pagamento inválido');
                break;
        }

        $newReceipt = new Receipt;
        $newReceipt->cliente_id = $validated['customer_id'];
        $newReceipt->data = $validated['date'];
        $newReceipt->preco_total_sem_iva = $validated['total_wo_tax'];
        $newReceipt->iva = $validated['tax'];
        $newReceipt->preco_total_com_iva = $validated['total_w_tax'];
        $newReceipt->nif = $validated['nif'];
        $newReceipt->nome_cliente = $validated['customer_name'];
        $newReceipt->tipo_pagamento = $validated['payment_type'];
        $newReceipt->ref_pagamento = $validated['payment_ref'];
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

            if ($validator->fails()) {
                $newReceipt->delete();
                return back()->withErrors($validator);
            }

            $validated = $validator->validate();

            $screening = Screening::find($validated['screening_id']);

            $canBuyTicket = $screening->data > now() ||
                ($screening->data->format('d/m/Y') == now()->format('d/m/Y')
                    && $screening->horario_inicio->format('H:i') >= now()->subMinutes(5)->format('H:i')
                );

            if (!$canBuyTicket) {
                $newReceipt->delete();
                return back()->withErrors(['screening_expired' => 'Não é possível comprar bilhetes para sessões que já começaram há mais de 5 minutos']);
            }

            if (Ticket::where('lugar_id', $cartTicket['seat']->id)->where('sessao_id', $cartTicket['screening']->id)->exists()) {
                $newReceipt->delete();
                session()->forget('cart');
                return back()->withErrors(['seat_occupied' => 'Já foi comprado um bilhete para este lugar nesta sessão']);
            }

            $newTicket = new Ticket;
            $newTicket->recibo_id = $validated['receipt_id'];
            $newTicket->cliente_id = $validated['customer_id'];
            $newTicket->sessao_id = $validated['screening_id'];
            $newTicket->lugar_id = $validated['seat'];
            $newTicket->preco_sem_iva = $validated['price_wo_tax'];
            $newTicket->save();
        }

        session()->forget('cart');

        $this->sendEmail($newReceipt);

        TicketController::generate_pdf($newReceipt);

        return redirect()
            ->route('receipts.show', $newReceipt->id)
            ->with('alert-icon', 'success')
            ->with('alert-color', 'green')
            ->with('alert-msg', 'Pagamento efetuado com sucesso! Receberá um email com a fatura em breve.');
    }

    public static function generate_pdf(Receipt $receipt)
    {
        $pdf = PDF::loadView('receipts.print.pdf', compact('receipt'))->setOptions(['defaultFont' => 'sans-serif']);
        $filePath = 'pdf_recibos/' . $receipt->id . '.pdf';
        if (Storage::put('public/' . $filePath, $pdf->output())) {
            $receipt->recibo_pdf_url = $filePath;
            $receipt->save();
            return true;
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function sendEmail($receipt)
    {
        $user = Auth::user();
        Mail::to($user)
            ->queue(new TicketsPurchased($receipt, $user));
    }

    public static function generate_ticket_pdf(Ticket $ticket)
    {
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate((route('employee.screenings.validate', $ticket->screening->id) . '?ticket=' . $ticket->id)));
        $pdf = PDF::loadView('tickets.print.pdf', compact('ticket', 'qrcode'))->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf;
    }

    public function get_pdf(Ticket $ticket)
    {
        //! Código vai ser diferente, os PDF dos bilhetes não são armazenados na BD
        //! É sempre gerado um PDF novo quando o cliente faz o pedido
        $pdf = $this->generate_ticket_pdf($ticket);
        if (!$pdf) {
            return redirect()->back()
                ->withErrors(['no_ticket_pdf' => 'Não foi possível gerar um PDF para esse bilhete. Tente novamente oumais tarde!']);
        }
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'bilhete-' . $ticket->id . '.pdf');
    }
}
