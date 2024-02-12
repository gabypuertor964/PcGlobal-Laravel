{{-- Extender desde el layout principal --}}
@extends('layouts.landing')

{{-- Declaracion complemento del titulo --}}
@section('title', $category->name)

{{-- Clases Css adicionales para el body --}}
@section('body_class','flex flex-col min-h-screen bg-gray-100')

{{-- Clases Css adicionales para el contenedor principal --}}
@section('main_class','container mt-3 mb-10 text-justify mx-auto flex-grow mx-2')

{{-- Declaracion de dependencias adicionales --}}
@section('dependences')
  @vite([
        
    //Bootstrap
    'resources/css/bootstrap.scss',
    'resources/css/app.css',
    'resources/js/font-awesome.js',
    'resources/css/tailwind.css',
  ])
@endsection

{{-- Contenido Principal --}}
@section('content')
  
  {{-- Titulo pagina --}}
  <h1 class="text-center font-bold text-2xl py-7">{{$category->name}}</h1>
  
  {{-- Menu de paginacion (Version movil) --}}
  <div class="sm:hidden flex justify-center"> {{ $products->links('pagination::tailwind') }}</div>

  <div class="productos grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    {{-- Producto a mostrar --}}
    @forelse ($products as $product)
      <a href="{{route('product.show',$product->slug)}}" class="product-card my-3 border rounded-md shadow">
    
        <h3 class="product-title p-3 text-center mx-10 font-medium">{{$product->brand->name}} - {{$product->name}}</h3>

        <img src="{{ asset('storage/products/'. strtoupper($product->slug)."/images/1.png") }}" alt="{{ $product->model}}" class="product-img my-3"> 

        <p class="text-center py-2 mx-10 mb-1">${{ number_format($product->price, 0, '.', '.') }} COP</p>
      </a>
    @empty
      <div class="flex flex-col w-full sm:w-1/2 mx-auto col-span-4">
        <p class="bg-red-600 text-center py-2 text-white font-semibold rounded">
          Aún no hay productos <i class="fa-solid fa-triangle-exclamation ms-1"></i>
        </p>
      </div>
    @endforelse

    <div class="hidden sm:flex sm:justify-center">{{ $products->links('pagination::tailwind') }}</div>
    
  </div>
@endsection