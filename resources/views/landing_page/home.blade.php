{{-- Declaracion e importacion componente principal --}}
@extends('layouts.landing_page')

{{-- Declaracion complemtento etiqueta litle del Header --}}
@section('title','Home')

{{-- Declaracion contenido principal de la pagina web --}}
@section('content')

  {{-- Declaracion y envio de clases personalidas a la etiqueta body presente en el componente principal--}}
  @section('body_class','flex flex-col min-h-screen bg-gray-100')

  {{-- Envio de clases personalizadas a la etiqueta main, la cual se encuentra en el componente principal--}}
  @section('main_class','container my-10 text-justify mx-auto flex-grow  mx-2')

  <div class="hidden md:grid grid-cols-3 gap-y-2 sm:gap-1 imgs-landing">
  
    <div class="sm:col-span-2">
      <div id="carouselExampleAutoplaying" class="carousel slide flex" data-bs-ride="carousel">

        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>

          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>

          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{asset('img/landing/f-1.jpg')}}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{asset('img/landing/f-2.jpg')}}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{asset('img/landing/f-4.jpg')}}" class="d-block w-100" alt="...">
          </div>
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

    <div class="flex flex-col justify-center gap-y-1">
      <img src="{{ asset('img/landing/f-5.jpg')}}" alt="" class="rounded object-contain cursor-pointer hover:rotate-1 transition-all duration-500">
      <img src="{{ asset('img/landing/f-3.jpg')}}" alt="" class="rounded object-contain cursor-pointer hover:-rotate-1 transition-all duration-500">
    </div>
  </div>
  <section class="mb-0 sm:my-16 mx-auto" id="categorias">
    <div class="flex flex-col gap-y-1">
      <h1 class="text-center text-2xl font-medium">Categorías de Productos</h1>
      <h2 class="text-center mb-10 ">Encuentra los mejores componentes al mejor precio</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 bg-gray-100 gap-6 transition-all">
      <div class="flex flex-col justify-center">
        <a href="{{route('categoria','tarjetas-graficas')}}" class="hover:text-gray-800">
          <img src="{{ asset('img/categorias/Tarjeta Gráfica.jpg')}}" class="rounded transition-all duration-300 hover:scale-95 hover:shadow-2xl" alt="Img de Tarjeta Gráfica">
          <p class="text-center py-2 font-medium text-lg text-gray-800">Tarjetas Gráficas</p>
        </a>
      </div>
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('categoria','procesadores')}}" class="hover:text-gray-800">
          <img src="{{ asset('img/categorias/procesador.jpg')}}" class="rounded transition-all duration-300 hover:scale-95 hover:shadow-2xl" alt="Img de Procesador">
          <p class="text-center py-2 font-medium text-lg">Procesadores</p>
        </a>
      </div>
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('categoria','perifericos')}}" class="hover:text-gray-800">
          <img src="{{ asset('img/categorias/Perifericos.jpg')}}" class="rounded transition-all duration-300 hover:scale-95 hover:shadow-2xl" alt="Img de Periféricos">
          <p class="text-center py-2 font-medium text-lg">Periféricos</p>
        </a>
      </div>
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('categoria','tarjetas-madre')}}" class="hover:text-gray-800">
          <img src="{{ asset('img/categorias/mother-board.jpg')}}" class="rounded transition-all duration-300 hover:scale-95 hover:shadow-2xl" alt="Img de Mother-Board">
          <p class="text-center py-2 font-medium text-lg">Tarjetas Madre</p>
        </a>
      </div>
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('categoria','fuentes-de-poder')}}" class="hover:text-gray-800">
          <img src="{{ asset('img/categorias/Fuente de poder.jpg')}}" class="rounded transition-all duration-300 hover:scale-95 hover:shadow-2xl" alt="Img de FdP">
          <p class="text-center py-2 font-medium text-lg">Fuentes de Poder</p>
        </a>
      </div>
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('categoria','rams')}}" class="hover:text-gray-800">
          <img src="{{ asset('img/categorias/ram.png')}}" class="rounded transition-all duration-300 hover:scale-95 hover:shadow-2xl" alt="Img de Ram">
          <p class="text-center py-2 font-medium text-lg">Ram's</p>
        </a>
      </div>
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('categoria','almacenamientos')}}" class="hover:text-gray-800">
          <img src="{{ asset('img/categorias/Almacenamiento.jpg')}}" class="rounded transition-all duration-300 hover:scale-95 hover:shadow-2xl" alt="Img de Almcenamiento">
          <p class="text-center py-2 font-medium text-lg">Almacenamiento</p>
        </a>
      </div>
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('categoria','cases')}}" class="hover:text-gray-800">
          <img src="{{ asset('img/categorias/cases.jpg')}}" class="rounded transition-all duration-300 hover:scale-95 hover:shadow-2xl" alt="Img de Cases">
          <p class="text-center py-2 font-medium text-lg">Cases</p>
        </a>
      </div>
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('categoria','monitores')}}" class="hover:text-gray-800">
          <img src="{{ asset('img/categorias/Monitores.jpg')}}" class="rounded transition-all duration-300 hover:scale-95 hover:shadow-2xl" alt="Img de Monitores">
          <p class="text-center py-2 font-medium text-lg">Monitores</p>
        </a>
      </div>
    </div>
  </section>
@endsection