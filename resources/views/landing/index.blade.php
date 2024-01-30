{{-- Declaracion e importacion componente principal --}}
@extends('layouts.landing')

{{-- Declaracion complemtento etiqueta litle del Header --}}
@section('title','Home')

{{-- Declaracion clases css adicionales al contenedor body --}}
@section('body_class','flex flex-col min-h-screen bg-gray-100')

{{-- Declaracion clases css adicionales al contenedor main --}}
@section('main_class','container my-8 text-justify mx-auto flex-grow  mx-2')

{{-- Declaracion contenido principal de la pagina web --}}
@section('content')
  <div class="hidden md:grid grid-cols-3 gap-y-2 sm:gap-1 imgs-landing -mt-3">

    <div class="sm:col-span-2">
      <div id="carouselExampleAutoplaying" class="carousel slide flex" data-bs-ride="carousel">

        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>

          <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>

          <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{asset('storage/carrousel/f-1.webp')}}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{asset('storage/carrousel/f-2.webp')}}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{asset('storage/carrousel/f-4.webp')}}" class="d-block w-100" alt="...">
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
      <img src="{{ asset('storage/carrousel/f-5.webp')}}" alt="" class="rounded object-contain cursor-pointer hover:-rotate-1 transition-all duration-200">

      <img src="{{ asset('storage/carrousel/f-3.webp')}}" alt="" class="rounded object-contain cursor-pointer hover:-rotate-1 transition-all duration-200">
    </div>
  </div>

  {{-- Enlaces de categorias --}}
  <section class="mb-0 sm:my-12 mx-auto" id="categories">

    {{-- Titulo sección --}}
    <div class="flex flex-col gap-y-1">
      <h1 class="text-lg text-center md:text-2xl font-medium">Categorías de Productos</h1>
      <h2 class="text-sm md:text-base text-center mb-10 ">Encuentra los mejores componentes al mejor precio</h2>
    </div>

    {{-- Imagenes enlace --}}
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 bg-gray-100 gap-6 transition-all">

      {{-- Seccion: Tarjetas graficas --}}
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('category.show','tarjetas-graficas')}}" class="hover:text-gray-800">
          <img loading="lazy" srcset="{{ asset('storage/categories/graphic_card.webp')}}" class="rounded ease-out duration-200 hover:scale-95 hover:shadow-2xl" alt="Img de Tarjeta Gráfica">
          <p class="text-center py-2 font-medium text-base lg:text-lg text-gray-800">Tarjetas Gráficas</p>
        </a>
      </div>

      {{-- Seccion: Procesadores --}}
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('category.show','procesadores')}}" class="hover:text-gray-800">
          <img loading="lazy" srcset="{{ asset('storage/categories/processor.webp')}}" class="rounded ease-out duration-200 hover:scale-95 hover:shadow-2xl" alt="Img de Procesador">
          <p class="text-center py-2 font-medium text-base lg:text-lg text-gray-800">Procesadores</p>
        </a>
      </div>

      {{-- Seccion: Perifericos --}}
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('category.show','perifericos')}}" class="hover:text-gray-800">
          <img loading="lazy" srcset="{{ asset('storage/categories/peripherals.webp')}}" class="rounded ease-out duration-200 hover:scale-95 hover:shadow-2xl" alt="Img de Periféricos">
          <p class="text-center py-2 font-medium text-base lg:text-lg text-gray-800">Periféricos</p>
        </a>
      </div>

      {{-- Seccion: Tarjetas Madre --}}
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('category.show','tarjetas-madre')}}" class="hover:text-gray-800">
          <img loading="lazy" srcset="{{ asset('storage/categories/mother_board.webp')}}" class="rounded ease-out duration-200 hover:scale-95 hover:shadow-2xl" alt="Img de Mother-Board">
          <p class="text-center py-2 font-medium text-base lg:text-lg text-gray-800">Tarjetas Madre</p>
        </a>
      </div>

      {{-- Seccion: Fuentes de Poder --}}
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('category.show','fuentes-de-poder')}}" class="hover:text-gray-800">
          <img loading="lazy" srcset="{{ asset('storage/categories/power_supply.webp')}}" class="rounded ease-out duration-200 hover:scale-95 hover:shadow-2xl" alt="Img de FdP">
          <p class="text-center py-2 font-medium text-base lg:text-lg text-gray-800">Fuentes de Poder</p>
        </a>
      </div>

      {{-- Seccion: Memorias Ram --}}
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('category.show','rams')}}" class="hover:text-gray-800">
          <img loading="lazy" srcset="{{ asset('storage/categories/ram.webp')}}" class="rounded ease-out duration-200 hover:scale-95 hover:shadow-2xl" alt="Img de Ram">
          <p class="text-center py-2 font-medium text-base lg:text-lg text-gray-800">Ram's</p>
        </a>
      </div>

      {{-- Seccion: Almacenamiento --}}
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('category.show','almacenamientos')}}" class="hover:text-gray-800">
          <img loading="lazy" srcset="{{ asset('storage/categories/storage.webp')}}" class="rounded ease-out duration-200 hover:scale-95 hover:shadow-2xl" alt="Img de Almcenamiento">
          <p class="text-center py-2 font-medium text-base lg:text-lg text-gray-800">Almacenamiento</p>
        </a>
      </div>

      {{-- Seccion: Gabinetes --}}
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('category.show','cases')}}" class="hover:text-gray-800">
          <img loading="lazy" srcset="{{ asset('storage/categories/cases.webp')}}" class="rounded ease-out duration-200 hover:scale-95 hover:shadow-2xl" alt="Img de Almcenamiento">
          <p class="text-center py-2 font-medium text-base lg:text-lg text-gray-800">Cases</p>
        </a>
      </div>

      {{-- Seccion: Monitores --}}
      <div class="flex flex-col justify-center transition-all">
        <a href="{{route('category.show','monitores')}}" class="hover:text-gray-800">
          <img loading="lazy" srcset="{{ asset('storage/categories/monitors.webp')}}" class="rounded ease-out duration-200 hover:scale-95 hover:shadow-2xl" alt="Img de Monitores">
          <p class="text-center py-2 font-medium text-base lg:text-lg text-gray-800">Monitores</p>
        </a>
      </div>
    </div>
    
  </section>
@endsection