<!DOCTYPE html>
<html lang="es">
    <head>

        {{-- Metadatos --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        {{-- Seccion de importacion de dependencias --}}
        @yield('dependences')

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

        {{-- Seccion de importacion de dependencias JS --}}
        @yield('scripts')
        
    </body>        
</html>