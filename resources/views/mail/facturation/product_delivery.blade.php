<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite([
        // Hojas de estilos personalizada
        'resources/css/app.css',

        //Tailwind CSS
        'resources/css/tailwind.css',

        //Bootstrap
        "resources/css/bootstrap.scss",

        //Bootstrap
        "resources/css/admin.css",
    ])
    <title>Tu recibo de compra - {{$facturation->client->fullName()}}</title>
</head>
<body class="flex flex-col min-h-screen justify-center relative" style="background: rgb(79, 70, 229, 0.86);">

        {{-- Logo --}}
        <img src="{{ asset('storage/others/logotype.png') }}" class="w-52 lg:w-64 block mx-auto lg:absolute top-0 left-0" alt="">

        {{-- Título --}}
        <div class="titles flex flex-col mt-6">
            <h1 class="w-fit mx-auto text-white">Tu compra fue entregada</h1>
            <h2 class="w-fit mx-auto text-white text-lg">{{ $facturation->client->fullName() }}</h2>
        </div>

        {{-- Card de la factura --}}
        <div class="bg-white shadow-md invoice-card email w-full my-6">
            {{-- Título: Información básica --}}
            <p class="text-lg text-center border-b w-fit mx-auto mt-3 font-medium">Información básica</p>
    
            {{-- Apartado: Información básica --}}
            <div class="invoice-card-content basics">
                <ul class="list-disc">
                    {{-- Fecha --}}
                    <li class="mt-3">
                        <span class="font-semibold">Fecha: </span> 
                        {{$facturation->datetime["date"]}}
                    </li>
    
                    {{-- Hora --}}
                    <li>
                        <span class="font-semibold">Hora: </span> 
                        {{$facturation->datetime["time"]}}
                    </li>
    
                    {{-- Estado --}}
                    <li>
                        <span class="font-semibold">Estado: </span> 
                        {{$facturation->state->name}}
                    </li>
                </ul>
            </div>
    
            {{-- Título: Detalles --}}
            <p class="text-lg text-center border-b w-fit mx-auto mt-3 font-medium">Detalles</p>
    
            {{-- Apartado: Detalles --}}
            <div class="invoice-card-content details grid grid-cols-1 lg:grid-cols-2">
                {{-- Subapartado: Productos --}}
                <ul class="border-r-0 lg:border-r my-2">
                    {{-- Título: Productos --}}
                    <p class="font-semibold text-center border-b-2 w-full md:w-fit mx-auto">Productos</p>
                    @foreach ($facturation->details as $detail)
                    <div class="border-s-4 border-slate-600/25 my-3 py-1 px-3">
                        {{-- Marca --}}
                        <li>
                            <span class="font-semibold">Marca: </span> 
                            {{$detail->product->brand->name}}
                        </li>
                        
                        {{-- Nombre/Modelo --}}
                        <li>
                            <span class="font-semibold">Nombre/Modelo: </span> 
                            {{$detail->product->name}}
                        </li>
                        
                        {{-- Cantidad --}}
                        <li>
                            <span class="font-semibold">Cantidad: </span> 
                            {{$detail->quantity}}
                        </li>
                        
                        {{-- Precio Unitario --}}
                        <li>
                            <span class="font-semibold">Precio Unitario: </span> 
                            ${{number_format($detail->unit_price, 0, ',', '.')}}
                        </li>
                        
                        {{-- Precio neto --}}
                        <li>
                            <span class="font-semibold">Precio Neto: </span> 
                            ${{number_format(($detail->unit_price * $detail->quantity), 0, ',', '.')}}
                        </li>
                    </div>
                    @endforeach
                </ul>
                
                {{-- Subapartado: Precios --}}
                <ul class="border-l-0 lg:border-l my-2">
                    {{-- Título: Productos --}}
                    <p class="font-semibold text-center border-b-2 w-full md:w-fit mx-auto">Precios</p>
                    <div class="border-s-4 border-slate-600/25 my-3 py-1 px-3">
                        {{-- Subtotal --}}
                        <li>
                            <span class="font-semibold">Subtotal: </span> 
                            ${{number_format($facturation->subtotal, 0, ',', '.')}}
                        </li>
    
                        {{-- Impuestos --}}
                        <li>
                            <span class="font-semibold">Impuestos ({{$facturation->tax_percentage}}%): </span> 
                            ${{number_format($facturation->taxes, 0, ',', '.')}}
                        </li>
    
                        {{-- Total --}}
                        <li>
                            <span class="font-semibold">Total: </span>
                            ${{number_format($facturation->total, 0, ',', '.')}}
                        </li>
                    </div>
                </ul>
            </div>
        </div>

        {{-- Gracias --}}
        <div class="greetings flex flex-col mb-6">
            <h1 class="w-fit mx-auto text-white text-2xl italic">Gracias por tu compra en PcGlobal</h1>
        </div>
</body>
</html>