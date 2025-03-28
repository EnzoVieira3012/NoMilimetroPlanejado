<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Exibe a página de login.
     */
    public function index()
    {
        return view('pages.login');
    }

    /**
     * Processa o login do usuário com MFA.
     */
    public function login(Request $request)
    {
        // Valida os campos do formulário
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'codigo' => 'required', // Código do Microsoft Authenticator
        ]);

        // Inicializa a resposta padrão como null
        $response = null;

        // Debug: Verificar se os dados estão chegando corretamente
        Log::info('Tentando login com:', $request->only('email', 'password', 'codigo'));

        // Verificar se o usuário existe no banco
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            Log::error('Usuário não encontrado com o email: ' . $request->email);
            $response = back()->withErrors(['email' => 'Usuário não encontrado.']);
        } else {
            // Autenticar o usuário com o e-mail e senha
            if (!Auth::attempt($request->only('email', 'password'))) {
                Log::error('Falha na autenticação de email/senha.');
                $response = back()->withErrors(['email' => 'As credenciais fornecidas estão incorretas.']);
            } else {
                // Validar o código MFA
                $mfaSecret = 'JBSWY3DPEHPK3PXP'; // Exemplo de segredo fixo
                $google2fa = new Google2FA();
                $isValid = $google2fa->verifyKey($mfaSecret, $request->input('codigo'));

                if (!$isValid) {
                    Log::error('Código MFA inválido para o usuário: ' . $request->email);
                    Auth::logout();
                    $response = back()->withErrors(['codigo' => 'O código MFA está incorreto.']);
                } else {
                    // Login bem-sucedido
                    Log::info('Login bem-sucedido.');
                    $response = redirect()->route('dashboard');
                }
            }
        }

        // Retorno único no final do método
        return $response;
    }
}
