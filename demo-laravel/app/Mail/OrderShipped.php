<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    protected  $email;
    protected $phone;
    protected $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$phone,$name)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.success',[
            'name'=>$this->name,
            'phone'=>$this->phone,
            'email'=>$this->email
        ]);
    }
}
