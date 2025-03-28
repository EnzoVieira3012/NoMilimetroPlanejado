<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; // Modelo Cliente
use App\Models\UserComment; // Modelo UserComment
use Dompdf\Dompdf;

class ClientController extends Controller
{
    /**
     * Exibe a página de lista de clientes.
     */
    public function index(Request $request)
    {
        // Busca os campos necessários e ordena do mais recente para o mais antigo
        $clientes = Client::select('id', 'nome', 'email', 'telefone', 'created_at')
            ->orderBy('created_at', 'desc') // Ordena por data de criação, mais recente primeiro
            ->get();

        // Verifica se a requisição é AJAX
        if ($request->ajax()) {
            // Retorna apenas o HTML do corpo da tabela
            return response()->json([
                'html' => view('partials.clientes_tabela', compact('clientes'))->render()
            ]);
        }

        // Caso contrário, retorna a página completa com a tabela
        return view('pages.clientes', compact('clientes'));
    }

    /**
     * Exibe a página para criar novos clientes.
     */
    public function create()
    {
        return view('pages.clientes-novo'); // Retorna a view para novos clientes
    }

    /**
     * Processa o registro de um novo cliente.
     */
    public function store(Request $request)
    {
        // Valida os campos do formulário
        $request->validate([
            'nome' => 'required|string|max:255', // Campo obrigatório
            'email' => 'nullable|email|max:255', // Opcional, mas deve ser um email válido
            'telefone' => 'required|string|max:20', // Campo obrigatório
            'comentarios' => 'nullable|string', // Opcional
        ]);

        // Salva os dados no banco de dados
        Client::create([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'comentarios' => $request->input('comentarios'),
        ]);

        // Redireciona para a página de lista de clientes com uma mensagem de sucesso
        return redirect()->route('clientes')->with('success', 'Cliente registrado com sucesso!');
    }

    /**
     * Exibe o perfil de um cliente específico.
     */
    public function profile($id)
    {
        // Busca o cliente pelo ID
        $cliente = Client::findOrFail($id); // Retorna 404 se o cliente não for encontrado

        // Renderiza a página de perfil do cliente
        return view('pages.clientes-perfil', compact('cliente'));
    }

    /**
     * Atualiza os dados de um cliente específico.
     */
    public function update(Request $request, $id)
    {
        // Valida os dados recebidos
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        // Busca o cliente pelo ID e atualiza os dados
        $cliente = Client::findOrFail($id);
        $cliente->update([
            'nome' => $request->input('nome'),
            'telefone' => $request->input('telefone'),
            'email' => $request->input('email'),
        ]);

        return response()->json(['message' => 'Cliente atualizado com sucesso!']);
    }

    /**
     * Salva o comentário de um usuário para um cliente específico.
     */
    public function storeUserComment(Request $request, $id)
    {
        // Valida o comentário recebido
        $request->validate([
            'comentario' => 'required|string|max:1000', // Comentário obrigatório
        ]);

        // Salva o comentário no banco de dados
        UserComment::create([
            'client_id' => $id,
            'comentario' => $request->input('comentario'),
        ]);

        // Redireciona para o perfil do cliente com uma mensagem de sucesso
        return redirect()->route('clientes.profile', $id)->with('success', 'Comentário adicionado com sucesso!');
    }

    /**
     * Retorna os comentários de um cliente específico.
     */
    public function getUserComments($id)
    {
        // Obtém os comentários do cliente
        $comentarios = UserComment::where('client_id', $id)->get();

        // Retorna os comentários como JSON
        return response()->json($comentarios);
    }

    /**
     * Remove um cliente pelo ID.
     */
    public function destroy($id)
    {
        // Busca o cliente pelo ID
        $cliente = Client::findOrFail($id);

        // Exclui o cliente
        $cliente->delete();

        // Retorna uma resposta de sucesso
        return response()->json(['message' => 'Cliente excluído com sucesso!'], 200);
    }

    /**
     * Gera um PDF com a lista de clientes.
     */
    public function generatePDF()
    {
        // Recuperar todos os clientes
        $clientes = Client::all();

        // Renderizar a view como HTML
        $html = view('pdf.clientes_pdf', compact('clientes'))->render();

        // Instanciar o Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // Tamanho e orientação do papel
        $dompdf->render();

        // Retornar o PDF gerado
        return $dompdf->stream('clientes.pdf');
    }
}
