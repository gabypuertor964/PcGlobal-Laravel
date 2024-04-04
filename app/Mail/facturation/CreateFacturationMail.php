<?php

namespace App\Mail\facturation;

use App\Http\Controllers\clients\FacturationController;
use App\Models\SaleInvoice;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
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
    private SaleInvoice $facturation;

    /**
     * Constructor del correo
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
    public function build()
    {
        // Esta vista se utiliza para generar el PDF de la factura de compra
        $pdf = SnappyPdf::loadView('mail.facturation.create_invoice', ['facturation' => $this->facturation]);
        // El pdf convertido a binario para enviar la variable al correo
        $pdfData = $pdf->output();

        // Vista principal del correo
        return $this->view('mail.facturation.mail')
            // Variable de la factura de compra
            ->with(['facturation' => $this->facturation])
            // Se le adjunta el pdf de la factura de compra
            ->attachData($pdfData, 'Tu_compra_' . $this->facturation->client->fullName() . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
