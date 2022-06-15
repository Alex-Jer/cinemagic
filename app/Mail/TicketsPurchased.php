<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

//Auxiliar class for generating the email html
class TicketsPurchased extends Mailable
{
    use Queueable, SerializesModels;

    private $receipt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.tickets.purchased')
            ->with([
                'receipt' => $this->receipt,
            ]);
    }
}
