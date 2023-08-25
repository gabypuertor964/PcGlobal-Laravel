<!-- Barra de Navegación -->
<header class="h-24 bg-indigo-600 overflow-hidden">
  <nav class="mx-4 sm:mx-12 flex font-medium text-white h-full items-center text-sm gap-x-6 gap-y-3">
    <div class="nav-1 flex flex-col sm:flex-row items-center justify-between w-full h-full">
      <!-- Logo #1 (Para pantallas más grandes que las de celular) -->
      <div class="nav-logo-pag pe-10 py-2 hidden sm:flex">
        <a href="{{route('index')}}" class="text-white hover:text-gray-400">
          <p>Logo</p>
        </a>
      </div>
      <!-- Formulario de búsqueda -->
      <div class="flex flex-grow px-2 sm:px-4 justify-center">
        <form action="#" class="flex nav-search">
          <input type="text" class="w-full sm:w-96 rounded-l-lg px-3 py-2 focus:ring-2 focus:ring-sky-500 text-gray-800" placeholder="¿Qué estás buscando?">
          <button class="w-16 bg-white py-2 px-4 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-sky-500">
            <i class="fa-sharp fa-solid fa-magnifying-glass text-gray-700 text-lg"></i>
          </button>
        </form>
      </div>
      <div class="nav-right flex gap-12 w-full sm:w-fit">
        <!-- Enlaces de productos -->
        <div class="nav-productos justify-evenly hidden lg:flex gap-4 ps-3">
          <p><a class="hover:text-gray-200" href="{{route('categorias')}}">Categorías</a></p>
          <p><a class="hover:text-gray-200" href="#">PQRS</a></p>
        </div>
        <!-- Enlaces de login y carrito -->
        <div class="nav-login hidden lg:flex gap-4">
          <a href="{{route("login")}}" class="hover:text-gray-200">
            <i class="fa-regular fa-user"></i>
          </a>
          <div class="border"></div>
          <p><a href="" class="hover:text-gray-200"><i class="fa-solid fa-cart-shopping"></i></a></p>
        </div>
        <!-- Logo #2 (Este es para el responsive) -->
        <div class="nav-logo-pag py-2 flex lg:hidden gap-3 w-full justify-between mt-1 items-center">
          <a href="{{route('index')}}" class="text-white flex sm:hidden hover:text-gray-400">
            <p class="">Logo</p>
          </a>
          {{-- Ícono del menú --}}
          <button><i class="fa-solid fa-bars text-md bg-indigo-700 p-2 rounded-md" id="boton-menu-responsive"></i></button>
        </div>
      </div>
    </div>
  </nav>
</header>
{{-- Links a diferentes sitios de la página usando los coponentes de blade--}}
<div class="pt-2 pb-3 hidden lg:hidden bg-indigo-600 text-white border-t" id="menu-responsive">
  <div class="flex flex-col gap-y-1">
    <x-responsive-nav-links href="{{route('index')}}" :active="request()->routeIs('index')">
      Inicio
    </x-responsive-nav-links>
    <x-responsive-nav-links href="{{route('categorias')}}" :active="request()->routeIs('categoria')">
      Categorías
    </x-responsive-nav-links>

    <div class="separador border-t my-2"></div>

    <div class="pl-4 text-xs flex items-center gap-2 my-0.5">
      <i class="fa-regular fa-user"></i>
      <p class="font-semibold">Inicia sesión o crea una cuenta</p>
    </div>
    <x-responsive-nav-links href="{{route('login')}}" :active="request()->routeIs('login')">
      Inicia sesión
    </x-responsive-nav-links>
    <x-responsive-nav-links href="{{route('registerView')}}" :active="request()->routeIs('registerView')">
      Crea una cuenta
    </x-responsive-nav-links>
  </div>
</div>