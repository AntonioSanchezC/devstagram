<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;



class PostController extends Controller
{
    //Asegura que el usuario haya autenticado
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }


    public function index(User $user)
    {
        $post = Post::where('user_id', $user->id)->latest()->paginate(3);
        return view('dashboard', [
            'user' => $user,
            'posts' => $post

        ]);
    }
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'titulo' => 'required|max:255',
            'descripcion'=>'required',
            'imagen' => 'required'
        ]);

        // Post::create([
            // 'titulo' => $request->titulo,
            // 'descripcion'=>$request->descripcion,
            // 'imagen' => $request->imagen,
            // 'user_id'=> auth()->user()->id
        // ]);

        //Otra forma de crear registros
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

            //mas usado en laravel
        $request->user()->post()->create([
            'titulo' => $request->titulo,
            'descripcion'=>$request->descripcion,
            'imagen' => $request->imagen,
            'user_id'=> auth()->user()->id

        ]);

        return redirect()->route('post.index',auth()->user()->username);

    }


    //controlador para efectos en las imagenes subidas
    public function show(User $user,Post $post)
    {
        return view('post.show',[
            'post' => $post,
            // la metimos cuando añadimos el comentario
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();

            //Eliminar la imagen al eliminar el post
            $imagen_path = public_path('uploads/' . $post->imagen);

            if (File::exists($imagen_path))
            {
                unlink($imagen_path);
                //otra forma de a¡hacerlo es
                // File::delete() <-pero tiende al error
            }

            return redirect()->route('post.index',
            auth()->user()->username);

    }

}

// session_start();

// $_SESSION['email'] = $resultado['email'];
