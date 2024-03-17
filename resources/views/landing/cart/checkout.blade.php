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
        <div id="loader-overlay">
            <div class="loader"></div>
          </div>
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
                                        <td>
                                            <form action="{{route("cart.update")}}" method="post" class="w-full mx-auto" id="cartForm">
                                                @csrf
                                  
                                                <input type="hidden" name="rowId" value="{{$cartProduct->rowId}}">
                                                <input type="hidden" name="slug" value="{{$cartProduct->options->slug}}">
                                  
                                                <div class="flex flex-col lg:flex-row gap-2">
                                                  <div class="relative flex">
                                                    <input type="button" value="-" class="minus absolute left-0 top-1/2 transform -translate-y-1/2 p-1 font-semibold">
                                                    <input type="number" name="qty" id="valueProduct" min="1" max="{{$cartProduct->options->stock}}" value="{{ $cartProduct->qty }}" class="bg-indigo-200 text-center px-4 py-1 rounded font-semibold h-full w-full lg:w-auto">
                                                    <input type="button" value="+" class="plus absolute right-0 top-1/2 transform -translate-y-1/2 p-1 font-semibold">
                                                  </div>
                                                </div>
                                  
                                            </form>
                                        </td>
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
                        <div class="w-full" id="sectionCard">
                            <div id="paypal-button-container"></div>
                        </div>
                        <a role="button" href="{{route("index", "#categories")}}" class="text-indigo-600 border-2 text-center border-indigo-600 px-3 py-1 rounded-xl hover:bg-indigo-600 hover:text-white transition-colors font-medium w-full">
                            Seguir comprando
                        </a>
                        <a role="button" href="{{route('cart.clear')}}"class="bg-red-600 text-white px-3 py-1 rounded-xl hover:bg-red-700 hover:text-white transition-colors font-medium w-full text-center">
                            Vaciar el carrito
                        </a>
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
                <a role="button" href="{{route("index", "#categories")}}" class="text-indigo-600 border-2 text-center border-indigo-600 px-3 py-1 rounded-xl hover:bg-indigo-600 hover:text-white transition-colors font-medium">
                    Seguir comprando
                </a>
            </section>
        @endif
    </div>
    @endsection

{{-- Sobreescritura/Eliminacion del la declaracion del footer del layout de donde se extiende --}}
@section('footer','')

{{-- Importacion de scripts --}}
@section('scripts')
  @routes
  @vite([
    'resources/js/navbar.js',
    'resources/js/search.js'
  ])
  <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&components=buttons,funding-eligibility"></script>
  <script>
    const loaderOverlay = document.getElementById('loader-overlay');
    const paypalButtonContainer = document.getElementById('paypal-button-container');
    
    if (paypalButtonContainer) { // Verificar si el contenedor del botón de PayPal existe
        paypal
            .Buttons({
                fundingSource: paypal.FUNDING.CARD,
                createOrder: function (data, actions) {
                    return actions.order.create({
                        application_context: {
                            shipping_preference: "NO_SHIPPING",
                        },
                        payer: {
                            email_address: "{{ $user->email }}",
                            name: {
                                given_name: "{{ $user->names }}",
                                surname: "{{ $user->surnames }}",
                            },
                            phone: {
                                phone_number: {
                                    national_number: "{{ $user->phone_number }}",
                                    country_code: "57",
                                },
                            },
                            address: {
                                country_code: "CO",
                            },
                        },
                        purchase_units: [
                            {
                                amount: {
                                    currency_code: "USD",
                                    value: "{{ intval(Cart::total() / 3893) }}",
                                },
                            },
                        ],
                    });
                },
                onApprove: function (data, actions) {
                    loaderOverlay.style.display = "block";


                    return fetch("/paypal/process/" + data.orderID)                        
                        .then((res) => res.json())
                        .then(function (response) {
                            if (!response.success) {
                                const msg =
                                    "Lo sentimos, tu transacción no pudo ser procesada, intenta más tarde.";
                                alert(msg);
                            } else {
                                // Vaciar el carrito y redireccionar al index
                                fetch("/cart/clear")
                                    .then(() => {
                                        location.href = response.url;
                                    })
                                    .catch((error) => {
                                        console.error(
                                            "Error al vaciar el carrito:",
                                            error
                                        );
                                        // En caso de error, redireccionar al index de todos modos
                                        location.href = response.url;
                                    });
                            }
                        })
                        .finally(() => {
                            loaderOverlay.style.display = "none"; // Ocultar la pantalla de carga una vez que la solicitud haya finalizado
                        });
                },
                onError: function (err) {
                    alert(err);
                },
            })
            .render("#paypal-button-container");
    }
  </script>
  <script>
    const minus = document.querySelector(".minus");
    const plus = document.querySelector(".plus");
    const valueProduct = document.getElementById("valueProduct");
    const cartForm = document.getElementById("cartForm");
    const minValue = parseInt(valueProduct.min);
    const maxValue = parseInt(valueProduct.max);

    minus.addEventListener("click", () => {
        if (parseInt(valueProduct.value) > minValue) {
            valueProduct.value = parseInt(valueProduct.value) - 1;
            cartForm.submit();
        }
    });

    plus.addEventListener("click", () => {
        if (parseInt(valueProduct.value) < maxValue) {
            valueProduct.value = parseInt(valueProduct.value) + 1;
            cartForm.submit();
        }
    });

    valueProduct.addEventListener("change", () => {
        const enteredValue = parseInt(valueProduct.value);
        if (enteredValue < minValue || enteredValue > maxValue || isNaN(enteredValue)) {
            valueProduct.value = 1;
            cartForm.submit();
        }
    });
  </script>


@endsection