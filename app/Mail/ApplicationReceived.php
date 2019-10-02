<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Application;

class ApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $applicationLink;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
        $this->applicationLink = route('employers.applications.details', [
            'application' => $application
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('employers.emails.application');
    }
}
