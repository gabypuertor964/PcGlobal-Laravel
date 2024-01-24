{{-- Extender desde el layout principal --}}
@extends('layouts.landing')

{{-- Declaracion complemento del titulo --}}
@section('title', $category->name)

{{-- Clases Css adicionales para el body --}}
@section('body_class','flex flex-col min-h-screen bg-gray-100')

{{-- Clases Css adicionales para el contenedor principal --}}
@section('main_class','container mt-3 mb-10 text-justify mx-auto flex-grow mx-2')

{{-- Contenido Principal --}}
@section('content')
  
  {{-- Titulo pagina --}}
  <h1 class="text-center font-bold text-2xl py-10">{{$category->name}}</h1>
  
  {{-- Menu de paginacion (Version movil) --}}
  <div class="sm:hidden flex justify-center"> {{ $products->links('pagination::tailwind') }}</div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 productos gap-4">

    {{-- Producto a mostrar --}}
    @forelse ($products as $product)
      <div class="my-3 border rounded shadow">
    
        <h3 class="p-3 text-center mx-10 border-b border-gray-600 font-medium">{{$product->brand->name}} | {{$product->model}}</h3>

        <img src="{{ asset('storage/products/'. strtoupper($product->slug)."/images/1.png") }}" alt="{{ $product->model}}" class="my-3"> 

        <p class="text-center py-2 border-t border-gray-600 mx-10">${{ number_format($product->price, 0, '.', '.') }} COP</p>
            
        <p class="flex">
          <a href="{{route('product.show',$product->slug)}}" class="bg-indigo-600 hover:bg-indigo-700 text-center mx-auto mb-3 rounded text-white py-2 px-8">
            Detalles
          </a>
        </p>
      </div>
    @empty
      <div class="flex flex-col w-full sm:w-1/2 mx-auto col-span-3">
        <p class="bg-red-600 text-center py-2 text-white font-semibold rounded">
          Por el momento no hay productos <i class="fa-regular fa-circle-xmark ms-1"></i>
        </p>
      </div>
    @endforelse

    <div class="hidden sm:flex sm:justify-center">{{ $products->links('pagination::tailwind') }}</div>
    
  </div>
@endsection