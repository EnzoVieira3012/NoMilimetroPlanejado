<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class LandingPageController extends Controller
{
    /**
     * Exibe a página inicial (Landing Page).
     */
    public function index()
    {
        return view('home'); // Exibe a view 'home.blade.php'
    }

    /**
     * Processa o registro de clientes no formulário da Landing Page.
     */
    public function storeClient(Request $request)
    {
        // Valida os campos do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefone' => 'required|string|max:20',
            'comentarios' => 'nullable|string',
        ]);

        // Salva os dados do cliente no banco de dados
        Client::create([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'comentarios' => $request->input('comentarios'),
        ]);

        // Retorna uma resposta JSON de sucesso
        return response()->json(['message' => 'Cliente registrado com sucesso!']);
    }
}
