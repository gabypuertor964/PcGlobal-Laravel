<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Codificacion de los caracteres-->
        <meta charset="UTF-8">

        <!-- -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- -->
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        {{--
            Nombre Directiva: @vite(['ruta/archivo','ruta_achivo'])

            Explicacion: Esta directiva emplea el servidor Vite para servir los archivos que se encuentran en la carpeta resources

            Nota: Esta directiva se puede emplear tanto en desarrollo (npm run dev), como en produccion (npm run build)
        --}}

        <!-- Importacion  Frameworks: Trailwind (Estilos Y componentes CSS + Responsividad)-->
        @vite('resources/css/app.css')

        <!-- Importacion Manual del Framework Fontwesome (Iconos)-->
        <link rel="stylesheet" href="{{asset('fontawesome-free-6.4.0-web/css/all.min.css')}}">
        
        <!-- Titulo Principal Pagina web (Nombre empresa + Titulo Personalizado)-->
        <title>@yield('title','Home') - PcGlobal</title>
    </head>

    {{-- 
        Nombre directiva: @yield('nombre_seccion','valor_default')
        
        Explicacion: Esta directiva declara un componente asignándole un nombre y un valor por defecto en caso de no declararse en la vista que importa el componente.
        
        Nota: En caso de no declarar un valor por defecto y tampoco asignarle un valor en la vista que importa el componente, laravel reportará error
        --}}
        <body class="@yield('body_class','')">
            
            {{-- Importancion Barra de navegacion --}}
            @include('components.navbars.landing_page')
            
            <main class="@yield('main_class','')">
                
                {{-- Importacion contenido principal pagina web --}}
                @yield('content')
                
            </main>                   
            
        {{-- Importancion Pie de Pagina --}}
        @include('components.footer')
        
    </body>
    {{-- Importación manual de archivos JavaScript --}}
    <script src="{{ asset('js/app.js') }}"></script>
</html>
