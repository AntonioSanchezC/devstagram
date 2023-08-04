<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('styles')
    <title>DevStagram - @yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
</head>
<body class="bg-gray-100">

    {{-- <h1 class="text-4xl font-extrabold">@yiele('titulo')</h1> --}}
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black">

                DevStagram
            </a>


            {{-- auth ya revisa si esta autenticado,
                entonces esto ya sirve como condicional if --}}
            @auth
                <nav class="flex gap-2 items-center">

                    <a
                        class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm
                        uppercase font-bold cursor-pointer"
                        href="{{route('post.create')}}"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 8.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v8.25A2.25 2.25 0 006 16.5h2.25m8.25-8.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-7.5A2.25 2.25 0 018.25 18v-1.5m8.25-8.25h-6a2.25 2.25 0 00-2.25 2.25v6" />
                      </svg>

                        Crear
                    </a>



                    <a
                        class="font-bold uppercase text-gray-600"
                        href="{{ route('post.index', auth()->user()->username)}}"
                    >
                        Hola:
                        <span class="font-normal">
                            {{ auth()->user()->username}}
                        </span>
                    </a>
                    <form method="post"action="{{ route('logout')}}" >
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600" >
                            Cerrar Sesión
                        </button>
                    </form>
                </nav>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600 text-sm" >Login</a>
                    <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm" >Crear Cuenta</a>
                </nav>
            @endguest


        </div>

    </header>

    <main class="container mx-auto mt-5">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
            @yield('contenido')
    </main>


    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase ">
       DevStagram - Todos los derechos reservados @php echo date('Y') @endphp
       {{ now() }}
    </footer>
    @livewireScripts
</body>
</html>



