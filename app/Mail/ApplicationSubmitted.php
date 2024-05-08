<?php

namespace App\Mail;

use App\Models\Application;
use App\Models\StudentLetter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $downloadUrl = '/download';
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Application $application, public StudentLetter $letter)
    {
        $this->downloadUrl = env('APP_URL').'/communication/download/'.$letter->id."/".$application->id."/letter";
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        
        return new Envelope(
            subject: $this->application->qualification->qualification_name.' '. $this->letter->letter_name,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'pages.communication.emails.applications.submitted',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
