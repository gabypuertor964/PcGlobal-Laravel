<?php

namespace App\Mail\facturation;

use App\Http\Controllers\clients\FacturationController;
use App\Models\SaleInvoice;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateFacturationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Propiedades del correo.
    */
    private SaleInvoice $invoice;

    /**
     * Constructor del correo
     */
    public function __construct(SaleInvoice $invoice)
    {
        // Asignar las propiedades
        $this->invoice = $invoice;

        // Añadir valores adicionales a las propiedades
        $this->invoice->tax_percentage = FacturationController::getTaxPercentage($this->invoice);
        $this->invoice->datetime = FacturationController::getDateTimeInArray($this->invoice->date_sale);
    }

    /**
     * Informacion de envio.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), "PcGlobal E-commerce"),
            subject: 'Recibo de Compra: Detalles de la Factura',
        );
    }

    /**
     * Contenido/Vista de correo.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.facturation.create_invoice',
            with: [
                'facturation' => $this->invoice
            ]
        );
    }

    /**
     * Archivos adjuntos en el correo electronico.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
