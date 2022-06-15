<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketsPurchased extends Mailable
{
    use Queueable, SerializesModels;

    private $receipt;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receipt, $user)
    {
        $this->receipt = $receipt;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('tickets.print.email')
            ->with([
                'receipt' => $this->receipt,
                'user' => $this->user,
            ]);
    }
}
