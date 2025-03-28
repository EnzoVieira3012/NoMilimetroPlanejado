<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import necessário para verificar a senha
use App\Models\User; // Certifique-se de importar o modelo correto
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    /**
     * Exibe a página do Perfil de Usuário.
     */
    public function index()
    {
        return view('pages.user-profile'); // Carrega a view user-profile.blade.php
    }

    /**
     * Atualiza os dados do Perfil de Usuário.
     */
    public function update(Request $request)
    {
        // Valida os dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Atualiza o usuário autenticado
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save(); // Salva as alterações no banco de dados

        return response()->json(['message' => 'Dados atualizados com sucesso!']);
    }

    /**
     * Faz o upload da imagem de perfil do usuário.
     */
    public function uploadProfileImage(Request $request)
    {
        // Validação do arquivo recebido
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Apenas imagens de até 2MB
        ]);

        // Obtém o usuário autenticado
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Verifica se há uma imagem antiga e a remove
        if ($user->profile_image) {
            $oldImagePath = public_path('uploads/profile_images/' . $user->profile_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Salva a nova imagem
        $image = $request->file('profile_image');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Nome único para a imagem
        $image->move(public_path('uploads/profile_images'), $imageName); // Move a imagem para a pasta pública

        // Atualiza o caminho da imagem no banco de dados
        $user->profile_image = $imageName;
        $user->save();

        return response()->json([
            'message' => 'Imagem enviada com sucesso!',
            'image_url' => asset('uploads/profile_images/' . $imageName),
        ]);
    }

    /**
     * Atualiza a senha do Perfil de Usuário.
     */
    public function updatePassword(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'current_password' => 'required|string', // Senha atual é obrigatória
            'new_password' => 'required|string|min:8|confirmed', // Nova senha deve ser confirmada
        ]);

        // Obtém o usuário autenticado
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Verifica se a senha atual está correta
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Senha atual incorreta.'], 422); // Retorna um erro
        }

        // Atualiza a senha do usuário (o mutator cuidará da criptografia)
        $user->password = $request->new_password;
        $user->save();

        return response()->json(['message' => 'Senha atualizada com sucesso!']);
    }

    public function deleteAccount(Request $request)
    {
        Log::info('Iniciando o método deleteAccount');

        // Valida a senha enviada pelo usuário
        $request->validate([
            'password' => 'required|string',
        ]);

        // Obtém o usuário autenticado
        $user = Auth::user();
        Log::info('Usuário autenticado encontrado', ['user_id' => $user->id]);

        // Verifica se a senha fornecida está correta
        if (!Hash::check($request->password, $user->password)) {
            Log::warning('Senha incorreta fornecida', ['user_id' => $user->id]);
            return response()->json(['message' => 'Senha incorreta.'], 422);
        }

        // Tenta deletar o usuário
        try {
            User::where('id', $user->id)->delete();
            Log::info('Usuário deletado com sucesso', ['user_id' => $user->id]);
        } catch (\Exception $e) {
            Log::error('Erro ao deletar o usuário', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Erro ao deletar conta.'], 500);
        }

        // Faz logout automaticamente
        Auth::logout();
        Log::info('Usuário desconectado', ['user_id' => $user->id]);

        return response()->json(['message' => 'Conta deletada com sucesso!']);
    }
}
