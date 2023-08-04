@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')

{{-- Esto estubo en accion hasta dar los componentes
    @if ($post->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 lx:grid-cols-4 gap-6 m-6">
        @foreach ($post as $post)
            <div>
                <a href="{{ route('post.show', ['post' => $post, 'user' => $user ]) }}">
                    <img src="{{ asset('uploads') . '/' . $post->imagen}}" alt="Imagen del Post {{$post->titulo}}">
                </a>
            </div>
        @endforeach
    </div>

    <div>
        {{$posts->links('pagination::simple-tailwind')}}
    </div>
    @else
        <a class="text-center">No hay un post</a>
    @endif --}}

    {{-- @forelse ($post as $post)
    <h1>{{ $post->titulo }}</h1>

    @empty
    <a href="">No hay un post</a>

    @endforelse --}}
{{--
    <x-listar-post >
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>
        <h1>Mostrando post desde slot</h1>
    </x-listar-post> --}}

    <x-listar-post :posts="$post" :user="$user" />

@endsection
