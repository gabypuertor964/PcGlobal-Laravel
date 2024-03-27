<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/tailwind.css', 'resources/css/pdf-styles.css'])
    <title>Tu pedido - {{ $facturation->client->fullName() }}</title>
</head>

<body>
    <header class="logotype-container font-semibold py-2">
        <img src="{{ asset('storage/others/logotype.png') }}" alt="PcGlobal Logo" class="logotype">
        <h1 class="text-center text-xl">¡Tu pedido ha sido entregado!</h1>
    </header>
    <main>
        <div class="invoice-card my-4 mx-auto">
            <p class="font-semibold text-center my-2">Tu información:</p>
            <div class="invoice-card-content basics">
                <ul class="list-disc">
                    <li>
                        <p>
                            <span class="font-semibold">Fecha: </span>
                            {{ $facturation->datetime['date'] }}
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="font-semibold">Hora: </span>
                            {{ $facturation->datetime['time'] }}
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="font-semibold">Estado: </span>
                            {{ $facturation->state->name }}
                        </p>
                    </li>
                </ul>
            </div>

            <p class="font-semibold text-center my-2">Detalles:</p>
            <div class="invoice-card-content products">
                <p class="font-medium text-center my-2">Productos</p>
                <div class="border mb-2"></div>
                @foreach ($facturation->details as $detail)
                    <ul class="list-none relative my-2">
                        <div class="border-2 absolute h-full left-0"></div>
                        {{-- Marca --}}
                        <li>
                            <span class="font-semibold">Marca: </span>
                            {{ $detail->product->brand->name }}
                        </li>

                        {{-- Nombre/Modelo --}}
                        <li>
                            <span class="font-semibold">Nombre/Modelo: </span>
                            {{ $detail->product->name }}
                        </li>

                        {{-- Cantidad --}}
                        <li>
                            <span class="font-semibold">Cantidad: </span>
                            {{ $detail->quantity }}
                        </li>

                        {{-- Precio Unitario --}}
                        <li>
                            <span class="font-semibold">Precio Unitario: </span>
                            ${{ number_format($detail->unit_price, 0, ',', '.') }}
                        </li>

                        {{-- Precio neto --}}
                        <li>
                            <span class="font-semibold">Precio Neto: </span>
                            ${{ number_format($detail->unit_price * $detail->quantity, 0, ',', '.') }}
                        </li>
                    </ul>
                @endforeach
            </div>

            <div class="invoice-card-content prices my-2">
                <p class="font-medium text-center my-2">Precios</p>
                <div class="border mb-2"></div>
                {{-- Subapartado: Precios --}}
                <ul class="relative">
                    <div class="border-2 absolute h-full left-0"></div>
                    <div class="my-3 py-1">
                        {{-- Subtotal --}}
                        <li>
                            <span class="font-semibold">Subtotal: </span>
                            ${{ number_format($facturation->subtotal, 0, ',', '.') }}
                        </li>

                        {{-- Impuestos --}}
                        <li>
                            <span class="font-semibold">Impuestos ({{ $facturation->tax_percentage }}%): </span>
                            ${{ number_format($facturation->taxes, 0, ',', '.') }}
                        </li>

                        {{-- Total --}}
                        <li>
                            <span class="font-semibold">Total: </span>
                            ${{ number_format($facturation->total, 0, ',', '.') }}
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </main>
    <footer>
        <p class="text-center my-3 text-lg font-semibold italic">¡Gracias por comprar en PcGlobal!</p>
    </footer>
</body>
