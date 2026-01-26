<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Traits\App;

class StatusChangeNotificationMail extends Mailable
{
    use Queueable, SerializesModels, App;

    public $record;      // full model instance
    public $modelName;
    public $statusText;  // Published / Draft

    /**
     * Create a new message instance.
     *
     * @param mixed $record    The model instance (e.g., News, Event)
     * @param string $modelName
     * @param string $statusText
     */
    public function __construct($record, $modelName, $statusText)
    {
        $this->record     = $record;
        $this->modelName  = $modelName;
        $this->statusText = $statusText;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $common_settings = $this->getSettings();

        // Prepare data for view
        $data = [
            'common_settings' => $common_settings,
            'title'           => $this->record->title ?? '',
            'slug'            => $this->record->slug ?? '',
            'status'          => $this->statusText,
            'type'            => $this->record->type ?? '',
            'modelName'       => $this->modelName
        ];

        return $this->subject("Content Status Updated")
                    ->view('email.status-change-notification')
                    ->with($data);
    }
}
