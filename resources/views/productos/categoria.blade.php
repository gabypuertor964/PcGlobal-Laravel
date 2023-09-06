{{-- Declaracion e importacion componente principal --}}
@extends('layouts.landing_page')

{{-- Declaracion complemtento etiqueta title del Header, la variable $categoria se pasa mediante el controlador y se detecta con el switch --}}
@section('title', $categoria->nombre_categoria)


{{-- Declaracion contenido principal de la pagina web --}}
@section('content')

  {{-- Declaracion y envio de clases personalidas a la etiqueta body presente en el componente principal--}}
  @section('body_class','flex flex-col min-h-screen bg-gray-100')

  {{-- Envio de clases personalizadas a la etiqueta main, la cual se encuentra en el componente principal--}}
  @section('main_class','container mt-3 mb-10 text-justify mx-auto flex-grow mx-2')
  
    <h1 class="text-center font-bold text-2xl py-10">{{$categoria->nombre_categoria}}</h1>
    <div class="sm:hidden flex justify-center"> {{ $productos->links('pagination::tailwind') }}</div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 productos gap-4">
      @forelse ($productos as $producto)
        <div class="my-3 border rounded shadow">
          <h3 class="p-3 text-center mx-10 border-b border-gray-600 font-medium">{{$producto->modelo}}</h3>
          <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->Nombre}}" class="my-3"> 
          {{-- Se accede a la carpeta 'storage/' y se accede a la posicón del registro para cargar la imágen --}}
          <p class="text-center py-2 border-t border-gray-600 mx-10">${{ number_format($producto->precio, 0, '.', '.') }} COP</p>
          {{-- El segundo argumento de number_format especifica la cantidad de decimales (en este caso, 0), el tercer argumento es el separador decimal (en este caso, un punto) y el cuarto argumento es el separador de miles (también un punto). --}}
          <p class="flex">
            <a href="{{route('categoria.producto',[$categoria->slug,$producto->slug])}}" class="bg-indigo-600 hover:bg-indigo-700 text-center mx-auto mb-3 rounded text-white py-2 px-8">Detalles</a>
          </p>
        </div>
      @empty
        <div class="flex flex-col w-full sm:w-1/2 mx-auto col-span-3">
          <p class="bg-red-600 text-center py-2 text-white font-semibold rounded">
            Por el momento no hay productos <i class="fa-regular fa-circle-xmark ms-1"></i>
          </p>
        </div>
      @endforelse
    </div>
    <div class="hidden sm:flex sm:justify-center">{{ $productos->links('pagination::tailwind') }}</div>
@endsection