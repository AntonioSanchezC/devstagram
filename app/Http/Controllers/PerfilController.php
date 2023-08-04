<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        //Modificar el Resquet
        $request->request->add(['username' => Str::slug($request->username)]);

        $request->validate([
            // 'username' => 'required|unique:users|min:3|max:20'
            'username' => [
                'required',
                // "unique:users,username,{auth()->user()->username}",
                Rule::unique('users', 'username')->ignore(auth()->user()),
                'min:3',
                'max:20',
                'not_in:twitter,edita-perfil'
                ],

                'email' => 'required|email|unique:users,imagen,'.auth()->user()->id,
                'oldpassword' => 'required|min:6'

        ]);


        if($request->imagen)
        {
           $imagen = $request->file('imagen');

           $nombreImagen = Str::uuid() .".". $imagen->extension();

           $imagenServidor = Image::make($imagen);
           $imagenServidor->fit(1000,1000);

           $imagenPath = public_path('perfiles').'/'.$nombreImagen;
           $imagenServidor->save($imagenPath);

        }


        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        if( $request->password) {
            $this->validate($request, [
                'password' => 'required',
            ]);

            if (Hash::check($request->oldpassword, auth()->user()->password)) {
                $usuario->password = Hash::make($request->password) ?? auth()->user()->password;
                $usuario->save();
            } else {
                return back()->with('mensaje', 'La Contraseña Actual no Coincide');
            }
        }

        // Redireccionar
        return redirect()->route('post.index',$usuario->username);


    }
}
