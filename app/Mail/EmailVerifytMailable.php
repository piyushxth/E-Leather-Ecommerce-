<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Cart;
class EmailVerifytMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $data_array = $this->data;

        $email = config('mail.from.address');
        $from_name = config('mail.from.name');


        return $this->from($email,$from_name)
            ->subject('Account Password Reset')
            ->view('mail.verify',compact('data_array'));

    }
}
