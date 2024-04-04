<?php

namespace App\Mail\facturation;

use App\Http\Controllers\clients\FacturationController;
use App\Models\SaleInvoice;
use Barryvdh\Snappy\Facades\SnappyPdf;
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
    private SaleInvoice $facturation;

    /**
     * Create a new message instance.
     */
    public function __construct(SaleInvoice $facturation)
    {
        // Asignar las propiedades
        $this->facturation = $facturation;

        // Añadir valores adicionales a las propiedades
        $this->facturation->tax_percentage = FacturationController::getTaxPercentage($this->facturation);
        $this->facturation->datetime = FacturationController::getDateTimeInArray($this->facturation->date_sale);
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
     * Contenido/Vista de correo.
     */
    public function build()
    {
        // Esta vista se utiliza para generar el PDF de la factura de entrega
        $pdf = SnappyPdf::loadView('mail.facturation.product_delivery', ['facturation' => $this->facturation]);
        // El pdf convertido a binario para enviar la variable al correo
        $pdfData = $pdf->output();

        // Vista principal del correo
        return $this->view('mail.facturation.mail')
            // Se le pasa la variable de la factura de compra
            ->with(['facturation' => $this->facturation])
            // Se le adjunta el pdf de la factura de entrega
            ->attachData($pdfData, 'Tu_pedido_' . $this->facturation->client->fullName() . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
