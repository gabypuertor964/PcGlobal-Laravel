{{-- Declaracion e importacion componente principal --}}
@extends('layouts.product')

{{-- Declaracion complemtento etiqueta title del Header --}}
@section('title', $product->model . " - " . $product->category->name)

{{-- Declaracion y envio de clases personalidas a la etiqueta body presente en el componente principal--}}
@section('body_class','flex flex-col min-h-screen bg-gray-100')

{{-- Envio de clases personalizadas a la etiqueta main, la cual se encuentra en el componente principal--}}
@section('main_class','container mt-3 mb-10 text-justify mx-auto flex-grow mx-2')

{{-- Declaracion de dependencias adicionales --}}
@section('dependences')
  @vite([
    //Bootstrap
    'resources/css/bootstrap.scss',
    'resources/js/bootstrap.js',
  ])
@endsection


{{-- Declaracion contenido principal de la pagina web --}}
@section('content')
  
  {{-- Boton regresar --}}
  <div class="contenedor mx-8 my-3 text-sm hover:underline">
    <a href="{{route('index')}}" class="hover:text-blue-600 hover:underline inline-flex items-center gap-1">
      <i class="fa-solid fa-share fa-flip-horizontal"></i><p>Volver</p>
    </a>
  </div>

  <div class="contenedor grid grid-cols-1 md:grid-cols-3 my-6 gap-4 py-3 bg-white px-3 mx-8 rounded-lg"> 

    <div class="flex flex-col text-center font-medium col-span-2">
      <div id="carouselExampleAutoplaying" class="carousel slide flex" data-bs-ride="carousel">

        {{-- Enlaces inferiores --}}
        <div class="carousel-indicators">
          @for ($indice = 0; $indice < count($directory); $indice++)
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{$indice}}" class="active" aria-current="true" aria-label="Slide 1"></button>    
          @endfor
        </div>

        <div class="carousel-inner">

          @foreach ($directory as $key => $vaue)

            <div class="carousel-item active">
              <img src="{{asset('storage/products/'.strtoupper($product->slug)."/images/$directory[$key]")}}" class="d-block w-100" alt="...">
            </div>
          @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>  
    </div>

    <aside class="flex flex-col p-2 sm:p-3 desc-producto gap-y-2 text-start ms-3 sm:ms-0 ">
      <p class="text-gray-400 text-xs">Descripción del producto</p>

      <ul class="flex flex-col gap-y-2 sm:gap-y-4">
        <li class="text-lg lg:text-lg -mb-2 lg:-mb-4"><p class="font-semibold">{{$product->brand->name}}</p></li>

        
        <li class="text-xl lg:text-2xl hover:underline">
          <p class="font-bold">{{$product->model}}</p>
        </li>

        <li class="text-lg lg:text-xl">$ {{number_format($product->price, 0, '.', '.')}}</li>
      </ul>
      
      {{-- Especificaciones tecnicas --}}
      <div class="especificaciones prose prose-sm lg:prose-base my-2 hover:prose-h3:underline">
        {!! $product->specs !!}
      </div>            
      
    </aside>
  </div>

@endsection