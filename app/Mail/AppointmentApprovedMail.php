<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $meetLink;
    public $recipientEmail; // new property

    /**
     * Create a new message instance.
     */
    public function __construct(Appointment $appointment, $meetLink, $recipientEmail)
    {
        $this->appointment = $appointment;
        $this->meetLink = $meetLink;
        $this->recipientEmail = $recipientEmail; // pass email of recipient
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('CasaEarth Appointment')
                    ->view('emails.appointment_approved') // your Blade
                    ->with([
                        'appointment' => $this->appointment,
                        'meetLink' => $this->meetLink,
                        'recipientEmail' => $this->recipientEmail, // pass to Blade
                    ]);
    }
}
