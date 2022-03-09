<?php

namespace App\Jobs;

use App\Mail\OrderShipped;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected  $customer;
    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
       $this->customer = $data['customer'];
       $this->order = $data['order'];
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      // dd( $this->customer->email);
      Mail::to($this->customer['email'])->send(new OrderShipped($this->customer,$this->order));
    }
}
