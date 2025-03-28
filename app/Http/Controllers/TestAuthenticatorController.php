<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

class TestAuthenticatorController extends Controller
{
    /**
     * Exibe o formulário para testar o código do Microsoft Authenticator.
     */
    public function index()
    {
        return view('tests.test-authenticator'); // Ajustado para o novo caminho
    }

    /**
     * Valida o código inserido pelo usuário.
     */
    public function validateCode(Request $request)
    {
        $request->validate([
            'codigo' => 'required|numeric', // O código deve ser numérico
        ]);

        // O segredo fixo do Microsoft Authenticator
        $mfaSecret = 'JBSWY3DPEHPK3PXP';

        // Instancia o Google2FA para validar o código
        $google2fa = new Google2FA();
        $isValid = $google2fa->verifyKey($mfaSecret, $request->input('codigo'));

        // Retorna o resultado para a página
        return view('tests.test-authenticator', ['isValid' => $isValid, 'codigo' => $request->input('codigo')]);
    }
}
