<!DOCTYPE html>
<html lang="es">
    <head>

        {{-- Metadatos --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        {{-- Seccion de importacion de dependencias adicionales --}}
        @yield('dependences')

        {{-- Importacion de dependencias permanentes --}}
        @vite([
            //Estilos personalizados
            'public/resources/css/app.css',

            //Font-Awesome
            'resources/js/font-awesome.js',

            //Tailwind
            'resources/css/tailwind.css',
        ])

        {{-- Titulo Principal Pagina web (Nombre empresa + Titulo Personalizado) --}}
        <title>@yield('title','Home') - PcGlobal</title>

        {{-- Icono de la pagina web --}}
        <link rel="icon" type="image/x-icon" href="{{asset('favicons/favicon.ico')}}">
    </head>

    <body class="@yield('body_class','')">

        {{-- Importacion navbar --}}
        @yield('navbar')

        {{-- Clases css adicionales del contenedor principal --}}
        <main class="@yield('main_class','')">
            {{-- Contenido principal --}}
            @yield('content')                
        </main>
        
        {{-- Pie de pagina --}}
        @yield('footer')

        {{-- Imporacion scripts --}}
        @yield('scripts')
            @vite([
                'public/resources/js/app.js'
            ])
        @show
        
    </body>        
</html>