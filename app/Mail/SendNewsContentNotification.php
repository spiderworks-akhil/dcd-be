<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Traits\App;
use App\Models\ApprovalNotification;

class SendNewsContentNotification extends Mailable
{
    use Queueable, SerializesModels, App;

    public $record;
    public $approval;

    /**
     * Create a new message instance.
     *
     * @param mixed $record  The model instance (e.g., News, Event)
     * @param ApprovalNotification $approval
     */
    public function __construct($record, ApprovalNotification $approval)
    {
        $this->record = $record;
        $this->approval = $approval;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $common_settings = $this->getSettings();

        $subject = "Content Approval Request for {$this->approval->notifiable_type}: {$this->record->slug}";

        return $this->subject($subject)
            ->view('email.approval_preview')
            ->with([
                'common_settings'   => $common_settings,
                'title'             => $this->record->title ?? '',
                'short_description' => $this->record->short_description ?? '',
                'slug'              => $this->record->slug ?? '',
                'type'              => $this->record->type ?? '',
                'id'                => $this->record->id ?? '',
                'approval_id'       => $this->approval->id,
                'modelName'         => $this->approval->notifiable_type,
            ]);
    }
}
