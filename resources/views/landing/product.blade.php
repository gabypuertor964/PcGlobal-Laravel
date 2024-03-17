{{-- Declaracion e importacion componente principal --}}
@extends('layouts.landing')

{{-- Declaracion complemtento etiqueta title del Header --}}
@section('title', $product->name)

{{-- Declaracion y envio de clases personalidas a la etiqueta body presente en el componente principal--}}
@section('body_class','flex flex-col min-h-screen bg-gray-100')

{{-- Envio de clases personalizadas a la etiqueta main, la cual se encuentra en el componente principal--}}
@section('main_class','container mt-3 mb-10 text-justify mx-auto flex-grow mx-2')

{{-- Declaracion contenido principal de la pagina web --}}
@section('content')

  @include('components.custom-alert')
  <style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0; /* Espacio adicional para navegadores compatibles */
    }
    input[type=number] {
    -moz-appearance: textfield; /* Restaurar apariencia predeterminada en Firefox */
    }
    input[type=number]:focus,
    input[type=number]:focus-visible {
      outline: none;
      border: 1px solid rgb(0, 0, 0, 0.1);
    }
  </style>
  <div class="contenedor grid grid-cols-1 md:grid-cols-3 mt-3 gap-4 py-3 bg-white px-3 mx-8 rounded-lg"> 
    @if (count($directory) === 1)      
      <div class="flex flex-col text-center font-medium col-span-2">
        <div class="image-container-carousel mx-auto flex justify-center">
          <img src="{{asset('storage/products/'.strtoupper($product->slug)."/images/$directory[2]")}}" class="d-block my-auto" alt="{{$product->model}}">
        </div>
      </div>
    @else
      <div class="flex flex-col text-center font-medium col-span-2">
        <div id="carouselExampleAutoplaying" class="carousel slide flex" data-bs-ride="carousel">

          {{-- Enlaces inferiores --}}
          <div class="carousel-indicators">
            @for ($indice = 0; $indice < count($directory); $indice++)
              <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{$indice}}" class="{{ $indice === 0 ? 'active' : '' }}"  aria-current="true" aria-label="Slide 1" style="background-color: rgb(79 70 229 / 1)"></button>    
            @endfor
          </div>

          <div class="carousel-inner">
            @foreach ($directory as $key => $value)
              {{--Esta validación se usa para que solo la primera imágen tenga la clase 'active' y que no se superpogan las img--}}
              <div class="carousel-item  {{ $key === 2 ? 'active' : '' }}">
                <div class="image-container-carousel mx-auto flex justify-center">
                  <img src="{{asset('storage/products/'.strtoupper($product->slug)."/images/$directory[$key]")}}" class="d-block my-auto" alt="{{$product->model}}">
                </div>
              </div>
            @endforeach
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: rgb(79 70 229 / 1); border-radius:35%;"></span>
            <span class="visually-hidden">Previous</span>
          </button>

          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" style="background-color: rgb(79 70 229 / 1); border-radius:35%;" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>  
      </div>
    @endif

    <aside class="flex flex-col p-2 sm:p-3 desc-producto gap-y-2 text-start ms-3 sm:ms-0 relative min-h-max">
      <p class="text-gray-400 text-xs">Descripción del producto</p>

      <ul class="flex flex-col gap-y-2 sm:gap-y-4">
        <div class="flex gap-1">
          <li class="text-lg lg:text-lg -mb-2 lg:-mb-4"><p class="font-semibold">{{$product->category->name}},</p></li>
          <li class="text-lg lg:text-lg -mb-2 lg:-mb-4"><p class="font-semibold">{{$product->brand->name}}</p></li>
        </div>
        
        <li class="text-xl lg:text-3xl hover:underline">
          <p class="font-bold">{{$product->name}}</p>
        </li>
        
        <li class="text-lg lg:text-xl">{{ $product->stock }} unidad(es)</li>
        <li class="text-lg lg:text-2xl">${{number_format($product->price, 0, ',', '.')}}</li>
      </ul>
      
      {{-- Descripcioón técnica --}}
      <div class="description prose prose-sm lg:prose-base mt-2 pb-20">
        {!! $product->description !!}
      </div>

      @if(!Auth::check() || (Auth::check() && Auth::user()->hasRole('cliente')))
        <div class="action-buttons relative md:absolute bottom-2 w-full pe-3 py-2 mt-5 flex flex-col gap-y-1">
          <div>
            @if($product->stock > 0)
              <form action="{{route("cart.add")}}" method="post" class="w-full mx-auto ">
                @csrf

                <input type="hidden" name="slug" value="{{$product->slug}}">

                <div class="flex flex-col lg:flex-row gap-2">
                  <div class="relative flex">
                    <span class="absolute -top-5 text-sm left-1/2 transform -translate-x-1/2 font-medium">Cantidad</span>
                    <input type="button" value="-" class="minus absolute left-0 top-1/2 transform -translate-y-1/2 p-1 font-semibold">
                    <input type="number" name="qty" id="valueProduct" min="1" max="{{$product->stock}}" value="1" class="bg-indigo-200 text-center px-4 py-1 rounded font-semibold h-full w-full lg:w-auto">
                    <input type="button" value="+" class="plus absolute right-0 top-1/2 transform -translate-y-1/2 p-1 font-semibold">
                  </div>

                  <input type="submit" name="btn" class="text-indigo-600 border-2 focus:outline-none focus-visible:outline border-indigo-600 px-3 py-2 rounded-xl hover:bg-indigo-600 hover:text-white transition-colors font-medium w-full disabled:opacity-75" value="Añadir al carrito">
                </div>

              </form>
            @else
              <div class="w-full bg-red-600 text-center py-2 text-white font-semibold rounded">Sin stock</div>
            @endif
          </div>
        </div>
      @endif
      
    </aside>
    {{-- Especificaciones técnicas --}}
    <section class="col-span-2">
      <h1 class="text-center font-semibold text-xl">Caracterísitcas</h1>
      <div class="specifications prose prose-table:border prose-headings:bg-slate-700 prose-headings:text-center prose-headings:text-white prose-td:text-sm prose-td:text-center prose-td:font-medium lg:prose-lg my-2 mx-auto w-full">
        {!! $product->specs !!}
      </div>
    </section>
  </div>

@endsection


{{-- Importacion de scripts --}}
@section('scripts')
    @routes
    @vite([
        'resources/js/navbar.js',
        'resources/js/scroll.js',
        'resources/js/search.js',
    ])
  <script>
    const minus = document.querySelector(".minus");
    const plus = document.querySelector(".plus");
    const valueProduct = document.getElementById("valueProduct");

    minus.addEventListener("click", () => {
        if (parseInt(valueProduct.value) > parseInt(valueProduct.min)) {
            valueProduct.value = parseInt(valueProduct.value) - 1;
        }
    });

    plus.addEventListener("click", () => {
        if (parseInt(valueProduct.value) < parseInt(valueProduct.max)) {
            valueProduct.value = parseInt(valueProduct.value) + 1;
        }
    });
  </script>

@endsection