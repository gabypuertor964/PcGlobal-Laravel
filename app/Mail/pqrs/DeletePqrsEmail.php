<?php

namespace App\Mail\pqrs;

use App\Models\Pqrs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeletePqrsEmail extends Mailable
{
    /**
     * Propiedades del correo.
    */
    private Pqrs $pqrs;

    /**
     * Create a new message instance.
     */
    public function __construct(Pqrs $pqrs)
    {
        // Asignar las propiedades
        $this->pqrs = $pqrs;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), "PcGlobal E-commerce"),
            subject: 'Eliminación de tu PQRS: Confirmación',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.pqrs.delete',
            with: [
                'pqrs' => $this->pqrs
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
