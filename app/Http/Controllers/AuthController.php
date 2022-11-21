<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $acesso = false;
        $dados = $request->input();
        $usuario = User::where('email', $dados['email'])->first();
        
        if(Hash::check($dados['senha'], $usuario->password))
        {
            $acesso = $usuario->remember_token;    
        }
       
        return response()->json([
            'token' => $acesso
        ], 200);
    }

    function register(Request $request)
    {
        $formulario = $request->input();

        $novoUsuario = new User();
        $novoUsuario->nome = $formulario['nome'];
        $novoUsuario->sobrenome = $formulario['sobrenome'];
        $novoUsuario->email = $formulario['email'];
        $novoUsuario->password = Hash::make($formulario['senha']);
        $novoUsuario->remember_token = Str::random(60);
        
        $isSaved = $novoUsuario->save();

        if($isSaved)
        {
            return response()->json([
                "mensage" => 'Usuário cadastrado com sucesso!',
                "token" => $novoUsuario->remember_token
            ],200);
        }else{
            return response()->json([
                "mensage" => 'Não foi possível cadastrar o usuário.'
            ],400);
        }
        
    }
}
