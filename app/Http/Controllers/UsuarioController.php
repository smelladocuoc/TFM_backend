<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use JWTAuth;

class UsuarioController extends Controller
{

    public function register(RegisterRequest $request){

        $usuario = Usuario::create([
            'usuario' => $request->usuario,
            'correo' => $request->correo,
            'password' => $request->password,
            'rol' => '0'
        ]);
    
        $token = JWTAuth::fromUser($usuario);

        return response()->json(compact('usuario', 'token'), 201);
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('correo', 'password');

        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        $usuario = Usuario::where('correo', $request->correo)->first();

        return response()->json(compact('usuario', 'token'), 200);


    }

    public function usuarioUpdateJSON(LoginRequest $request, $usuarioId){
        $usuario = Usuario::where('id', $usuarioId)->update([
            'usuario' => $request->usuario,
            'correo' => $request->correo,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);

        return response()->json(compact('usuario'), 201); 
    }

    public function usuarioJSON($usuarioId){

        $usuario = Usuario::find($usuarioId);

        return $usuario;

    }
}
