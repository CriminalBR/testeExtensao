<?php

// Dentro de app/Http/Controllers/ItemEstoqueController.php

namespace App\Http\Controllers;

use App\Models\ItemEstoque; // Certifique-se que o Model está sendo usado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar o Facade Auth

class ItemEstoqueController extends Controller
{
    // Adicionar este construtor para proteger todas as rotas do controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * (Listar os itens do usuário logado)
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id(); // Pega o ID do usuário logado
        $itens = ItemEstoque::where('user_id', $userId)->latest()->get(); // Busca apenas os itens deste usuário, ordenados pelos mais recentes

        // Retorna a view de listagem (que criaremos a seguir)
        return view('estoque.index', ['itens' => $itens]);
    }

    /**
     * Show the form for creating a new resource.
     * (Mostrar o formulário para adicionar novo item)
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retorna a view do formulário (que criaremos a seguir)
        return view('estoque.create');
    }

    /**
     * Store a newly created resource in storage.
     * (Salvar o novo item no banco)
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'nullable|string',
        ]);

        // Cria um novo item associado ao usuário logado
        $item = new ItemEstoque();
        $item->nome = $request->nome;
        $item->quantidade = $request->quantidade;
        $item->descricao = $request->descricao;
        $item->user_id = Auth::id(); // Fundamental associar ao usuário logado!
        $item->save();

        // Redireciona de volta para a lista com mensagem de sucesso
        return redirect()->route('estoque.index')->with('success', 'Item adicionado com sucesso!');
    }

    // --- Os métodos show, edit, update, destroy são criados pelo --resource
    // --- mas precisam ser implementados depois, lembrando de verificar o user_id ---

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemEstoque  $itemEstoque
     * @return \Illuminate\Http\Response
     */
    public function show(ItemEstoque $itemEstoque)
    {
        // Implementar depois (lembrar de verificar se $itemEstoque->user_id == Auth::id())
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemEstoque  $itemEstoque
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemEstoque $itemEstoque)
    {
         // Implementar depois (lembrar de verificar se $itemEstoque->user_id == Auth::id())
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemEstoque  $itemEstoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemEstoque $itemEstoque)
    {
         // Implementar depois (lembrar de verificar se $itemEstoque->user_id == Auth::id())
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemEstoque  $itemEstoque
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemEstoque $itemEstoque)
    {
         // Implementar depois (lembrar de verificar se $itemEstoque->user_id == Auth::id())
    }
}