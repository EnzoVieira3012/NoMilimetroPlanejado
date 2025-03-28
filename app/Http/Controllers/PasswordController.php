<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Exibe a página de mudança de senha (primeira fase).
     */
    public function index()
    {
        return view('pages.password'); // Renderiza a view de mudança de senha
    }

    /**
     * Envia o código de redefinição de senha para o e-mail.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('password', ['step' => 1])
                             ->withErrors(['email' => 'Usuário não encontrado.']);
        }

        $codigo = rand(100000, 999999);
        $user->reset_code = $codigo;
        $user->save();

        Mail::to($user->email)->send(new ResetPasswordMail($codigo));

        return redirect()->route('password', ['step' => 2])
                         ->with('success', 'Código de redefinição enviado para o e-mail ' . $request->email);
    }

    /**
     * Processa a redefinição de senha.
     */
    public function resetPassword(Request $request)
    {
        // Validação dos dados enviados pelo formulário
        $request->validate([
            'codigo' => 'required',
            'nova_senha' => 'required|min:8',
        ]);

        // Busca o usuário com base no código de redefinição
        $user = User::where('reset_code', $request->codigo)->first();

        // Verifica se o código é inválido ou expirado
        if (!$user) {
            return back()->withErrors(['codigo' => 'Código inválido ou expirado.']);
        }

        // Atualiza a senha do usuário
        $user->password = $request->nova_senha; // Salva a nova senha como texto puro
        $user->reset_code = null; // Remove o código de redefinição
        $user->save(); // Salva as alterações no banco de dados

        // Redireciona para a página de login com uma mensagem de sucesso
        return redirect()->route('login')->with('success', 'Senha atualizada com sucesso.');
    }
}
