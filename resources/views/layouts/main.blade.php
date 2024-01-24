<!DOCTYPE html>
<html lang="es">
    <head>

        {{-- Metadatos --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        {{-- Importacion de dependencias --}}
        @yield('dependences')

        {{-- Titulo Principal Pagina web (Nombre empresa + Titulo Personalizado) --}}
        <title>@yield('title','Home') - PcGlobal</title>
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
            @include('components.footer')
        @show

        {{-- Imporacion scripts --}}
        @yield('scripts')
            @vite([
                'public/resources/js/app.js'
            ]);
        @show
        
    </body>        
</html>