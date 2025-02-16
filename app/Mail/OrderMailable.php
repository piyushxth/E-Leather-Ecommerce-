<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Cart;


class OrderMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data_array = $this->data;
        $cartItems = Cart::instance(auth()->user()->id)->content();
        $settings=Setting::firstOrFail();
        // dd($settings->phone_number);

        $email = config('mail.from.address');
        $from_name = config('mail.from.name');
        return $this->from($email,$from_name)
            ->subject('Order placed successfully')
            ->view('mail.Mail-tamplety-a1',compact('data_array','cartItems','settings'));
    }
}
