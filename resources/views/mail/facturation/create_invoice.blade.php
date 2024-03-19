<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        .img {
            width: 13rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
            top: 0px;
            left: 0px;
        }

        @media (min-width: 1024px) {
            .img {
                width: 16rem;
                position: absolute;
            }
        }

        .invoice-card {
            width: 100%;
            margin-inline: auto;
            border-radius: 20px;
            padding: 1rem;
        }

        .titles > .main-title {
            font-size: 1.4rem; 
        }

        .invoice-card .invoice-card-content {
            border-radius: 15px;
            padding: 0.5rem;
            background: #f3f3f3;
        }

        .invoice-card .invoice-card-content.details {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        .invoice-card .invoice-card-content.details > ul.products {
            list-style: none;
            border-right: 0px;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .invoice-card .invoice-card-content.details > ul.prices {
            list-style: none;
            border-left: 0px;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .shadow-md {
            --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }

        @media (min-width: 1024px) {
            .titles > .main-title {
                font-size: 2rem; 
            }

            .invoice-card {
                padding: 1rem 2.5rem;
                width: 50%;
            }
            
            .invoice-card {
                padding: 1rem 2.5rem;
                width: 70%;
            }

            .invoice-card .invoice-card-content.details {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .invoice-card .invoice-card-content.details > ul.products {
                border-right: 1px solid rgb(71 85 105 / 0.25);;
            }

            .invoice-card .invoice-card-content.details > ul.prices {
                border-left-width: 1px solid rgb(71 85 105 / 0.25);;
            }
        }

    </style>
    <title>Tu recibo de compra - {{$facturation->client->fullName()}}</title>
</head>
<body style="display:flex; flex-direction:column; min-height: 100vh; justify-content: center; position: relative; background: rgb(79, 70, 229, 0.86); margin:0; padding: 0; box-sizing: border-box;">

        {{-- Logo --}}
        <img src="{{ asset('storage/others/logotype.png') }}" class="img" alt="Img Logo">

        {{-- Título --}}
        <div class="titles" style="display:flex; flex-direction:column; margin-top: 1.5rem;">
            <h1 class="main-title" style="width: fit-content; margin-left: auto; margin-right: auto; color: #fff;">Tu compra ha sido registrada</h1>
            <h2 style="width: fit-content; margin-left: auto; margin-right: auto; color: #fff; font-size: 1.125rem; line-height: 1.75rem;">{{ $facturation->client->fullName() }}</h2>
        </div>

        {{-- Card de la factura --}}
        <div class="shadow-md invoice-card email" style="background: #fff; margin-top: 1.5rem; margin-bottom: 1.5rem;">
            {{-- Título: Información básica --}}
            <p style="font-size: 1.125rem; line-height: 1.75rem; text-align: center; border-bottom: 1px solid rgb(71 85 105 / 0.25); width: fit-content; margin-left: auto; margin-right: auto; margin-top: 0.75rem; font-weight: 500;">
                Información básica
            </p>
    
            {{-- Apartado: Información básica --}}
            <div class="invoice-card-content basics">
                <ul style="list-style-type: disc;">
                    {{-- Fecha --}}
                    <li style="margin-top: 0.75rem;">
                        <span style="font-weight: 600;">Fecha: </span> 
                        {{$facturation->datetime["date"]}}
                    </li>
    
                    {{-- Hora --}}
                    <li>
                        <span style="font-weight: 600;">Hora: </span> 
                        {{$facturation->datetime["time"]}}
                    </li>
    
                    {{-- Estado --}}
                    <li>
                        <span style="font-weight: 600;">Estado: </span> 
                        {{$facturation->state->name}}
                    </li>
                </ul>
            </div>
    
            {{-- Título: Detalles --}}
            <p style="font-size: 1.125rem; line-height: 1.75rem; text-align: center; border-bottom: 1px solid rgb(71 85 105 / 0.25); width: fit-content; margin-left: auto; margin-right: auto; margin-top: 0.75rem; font-weight: 500;">
                Detalles
            </p>
    
            {{-- Apartado: Detalles --}}
            <div class="invoice-card-content details">
                {{-- Subapartado: Productos --}}
                <ul class="products">
                    {{-- Título: Productos --}}
                    <p style="font-weight: 600; text-align: center; border-bottom: 2px solid rgb(71 85 105 / 0.25); width: fit-content; margin-left: auto; margin-right: auto;">Productos</p>
                    @foreach ($facturation->details as $detail)
                    <div style="border-left: 4px solid rgb(71 85 105 / 0.25); margin-top: 0.75rem; margin-bottom: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem; padding-left: 0.75rem; padding-right: 0.75rem;">
                        {{-- Marca --}}
                        <li>
                            <span style="font-weight: 600;">Marca: </span> 
                            {{$detail->product->brand->name}}
                        </li>
                        
                        {{-- Nombre/Modelo --}}
                        <li>
                            <span style="font-weight: 600;">Nombre/Modelo: </span> 
                            {{$detail->product->name}}
                        </li>
                        
                        {{-- Cantidad --}}
                        <li>
                            <span style="font-weight: 600;">Cantidad: </span> 
                            {{$detail->quantity}}
                        </li>
                        
                        {{-- Precio Unitario --}}
                        <li>
                            <span style="font-weight: 600;">Precio Unitario: </span> 
                            ${{number_format($detail->unit_price, 0, ',', '.')}}
                        </li>
                        
                        {{-- Precio neto --}}
                        <li>
                            <span style="font-weight: 600;">Precio Neto: </span> 
                            ${{number_format(($detail->unit_price * $detail->quantity), 0, ',', '.')}}
                        </li>
                    </div>
                    @endforeach
                </ul>
                
                {{-- Subapartado: Precios --}}
                <ul class="prices">
                    {{-- Título: Productos --}}
                    <p style="font-weight: 600; text-align: center; border-bottom: 2px solid rgb(71 85 105 / 0.25); width: fit-content; margin-left: auto; margin-right: auto;">Precios</p>
                    <div style="border-left: 4px solid rgb(71 85 105 / 0.25); margin-top: 0.75rem; margin-bottom: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem; padding-left: 0.75rem; padding-right: 0.75rem;">
                        {{-- Subtotal --}}
                        <li>
                            <span style="font-weight: 600">Subtotal: </span> 
                            ${{number_format($facturation->subtotal, 0, ',', '.')}}
                        </li>
    
                        {{-- Impuestos --}}
                        <li>
                            <span style="font-weight: 600">Impuestos ({{$facturation->tax_percentage}}%): </span> 
                            ${{number_format($facturation->taxes, 0, ',', '.')}}
                        </li>
    
                        {{-- Total --}}
                        <li>
                            <span style="font-weight: 600">Total: </span>
                            ${{number_format($facturation->total, 0, ',', '.')}}
                        </li>
                    </div>
                </ul>
            </div>
        </div>

        {{-- Gracias --}}
        <div class="greetings" style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">
            <h1 style=" width: fit-content; margin-left: auto; margin-right: auto; color: #fff; font-size: 1.5rem; line-height: 2rem; font-style: italic;">Gracias por comprar en PcGlobal</h1>
        </div>
</body>
</html>