<div>


{{--
    {{ $titulo }}
    <h1>{{ $slot }}</h1> --}}

    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 lx:grid-cols-4 gap-6 m-6">
        @foreach ($posts as $post)
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
    @endif

</div>
