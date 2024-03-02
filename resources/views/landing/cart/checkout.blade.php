{{-- Declaracion e importacion componente principal --}}
@extends('layouts.landing')

{{-- Declaracion complemtento etiqueta litle del Header --}}
@section('title','Carrito de Compras')

{{-- Declaracion clases css adicionales al contenedor body --}}
@section('body_class','flex flex-col min-h-screen')

{{-- Declaracion clases css adicionales al contenedor main --}}
@section('main_class','text-justify mx-2')

{{-- Declaracion contenido principal de la pagina web --}}
@section('content')
    @include('components.shopping-cart-alert')
    <div>
        @if ($cartContent)
        <h1 class="text-center text-xl font-semibold py-2.5">Carrito de compras</h1>
        <section class="grid grid-cols-3 gap-2">
                <div class="card col-span-3 md:col-span-2">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th class="font-medium">Imágen</th>
                                <th class="font-medium">Nombre</th>
                                <th class="font-medium">Cantidad</th>
                                <th class="font-medium">Precio Unitario</th>
                                <th class="font-medium">Precio Total</th>
                                <th></th>
                            </thead>
                            <tbody>
                                 @foreach ($cartContent as $cartProduct)
                                     <tr class="align-middle">
                                        <td>
                                            <img src="{{ asset('storage/products/'. strtoupper($cartProduct->options->slug)."/images/". $cartProduct->options->image) }}" alt="{{ $cartProduct->name }}" width="50">
                                        </td>
                                        <td>
                                            <a class="product-name" href="{{route('product.show',$cartProduct->options->slug)}}">{{$cartProduct->name}}</a>
                                        </td>
                                        <td>{{($cartProduct->qty)}}</td>
                                        <td>${{number_format($cartProduct->price, 0, ',', '.')}}</td>
                                        <td>${{number_format($cartProduct->qty * $cartProduct->price, 0, ',', '.')}}</td>
                                        <td>
                                            <form action="{{route("cart.remove")}}" method="post">
                                                @csrf
                                                <input type="hidden" name="rowId" value="{{$cartProduct->rowId}}">
                                                <div class="button-tooltip" data-tooltip="Eliminar producto">
                                                    <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white w-full">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                     </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card col-span-3 md:col-span-1 py-2.5 px-3 flex flex-col gap-y-6">
                    <h2 class="text-center font-medium border-b pb-1.5">Resumen</h2>
                    <div class="summary">
                        <ul class="flex flex-col gap-y-0.5">
                            <div class="flex gap-0.5">
                                <li class="font-medium">Subtotal:</li>
                                <li>${{number_format(Cart::subtotal(), 0, ',', '.')}}</li> </li>
                            </div>
                            <div class="flex gap-0.5">
                                <li class="font-medium">Impuestos:</li>
                                <li>${{number_format(Cart::tax(), 0, ',', '.')}}</li> </li>
                            </div>
                            <div class="flex gap-0.5">
                                <li class="font-medium">Total:</li>
                                <li>${{number_format(Cart::total(), 0, ',', '.')}}</li> </li>
                            </div>
                        </ul>
                    </div>
                    <div class="flex flex-col gap-y-1.5">
                        <button class="bg-indigo-600 text-white px-3 py-1 rounded-xl hover:bg-indigo-700 hover:text-white transition-colors font-medium w-full">
                            Comprar
                        </button>
                        <button class="text-indigo-600 border-2 border-indigo-600 px-3 py-1 rounded-xl hover:bg-indigo-600 hover:text-white transition-colors font-medium w-full">
                            <a href="{{route('index', '#categories')}}">Seguir comprando</a>
                        </button>
                        <button class="bg-red-600 text-white px-3 py-1 rounded-xl hover:bg-red-700 hover:text-white transition-colors font-medium w-full">
                            <a href="{{route("cart.clear")}}">Vaciar el carrito</a>
                        </button>
                    </div>
                </div>
            </section>
        @else
            <section class="flex flex-col gap-y-3 text-center justify-center items-center">
                <img src="{{asset("storage/others/cart-empty.png")}}" style="aspect-ratio: 1/1; object-fit: cover; width:25%;" alt="Shopping Cart Empty">
                <div class="flex flex-col gap-0.5">
                    <h1 class="text-xl font-medium">El carrito de compras está vacío</h1>
                    <p>¡Parece que aún no has agregado ningún producto al carrito de compras!</p>
                </div>
                <button class="text-indigo-600 border-2 border-indigo-600 px-3 py-1 rounded-xl hover:bg-indigo-600 hover:text-white transition-colors font-medium">
                    <a href="{{route('index', '#categories')}}">Seguir comprando</a>
                </button>
            </section>
        @endif
    </div>
    @endsection

{{-- Sobreescritura/Eliminacion del la declaracion del footer del layout de donde se extiende --}}
@section('footer','')