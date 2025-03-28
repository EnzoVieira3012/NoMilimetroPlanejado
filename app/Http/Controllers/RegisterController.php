<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Exibe a página de registro.
     */
    public function index()
    {
        return view('pages.register'); // Renderiza a view de registro
    }

    /**
     * Processa o registro de um novo usuário.
     */
    public function register(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Cria o usuário no banco de dados
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'), // Sem bcrypt() aqui, porque o modelo já cuida disso
        ]);

        // Redireciona o usuário para a página de login com uma mensagem de sucesso
        return redirect()->route('login')->with('success', 'Conta criada com sucesso. Faça login para continuar!');
    }
}
