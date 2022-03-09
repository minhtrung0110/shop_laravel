<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    protected  $customer;
    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer,$order)
    {
        $this->customer = $customer;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.success',[
            'order'=>$this->order,
            'customer'=>$this->customer
        ]);
    }
}
