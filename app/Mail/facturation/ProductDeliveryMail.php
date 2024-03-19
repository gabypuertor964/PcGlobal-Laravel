<?php

namespace App\Mail\facturation;

use App\Http\Controllers\clients\FacturationController;
use App\Models\SaleInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductDeliveryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Propiedades del correo.
    */
    private SaleInvoice $invoice;

    /**
     * Create a new message instance.
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
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), "PcGlobal E-commerce"),
            subject: 'Entrega realizada: Detalles de tu pedido.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.facturation.product_delivery',
            with: [
                'facturation' => $this->invoice
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
