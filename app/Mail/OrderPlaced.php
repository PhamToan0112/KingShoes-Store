<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;
    public $cart;

    /**
     * Create a new message instance.
     *
     * @param mixed $bill
     * @param mixed $cart
     */
    public function __construct($bill, $cart)
    {
        $this->bill = $bill;
        $this->cart = $cart;
    }

    /** 
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Thông tin đơn hàng')
            ->view('emails.order_placed');
    }
}
