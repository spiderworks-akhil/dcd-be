<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Traits\App;

class ContactThankyou extends Mailable
{
    use Queueable, SerializesModels, App;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        $common_settings = $this->getSettings();
        return $this->subject('Thank you for contacting us - Etihadrail')->view('email.contact_thankyou')->with('common_settings', $common_settings);
    }
}
