<?php

namespace App\Http\Controllers;

use App\Models\ItemEstoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Importar Rule para validação unique

class ItemEstoqueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();
        // Paginação para melhor performance com muitos itens
        $itens = ItemEstoque::where('user_id', $userId)->latest()->paginate(15); // Exibe 15 itens por página
        return view('estoque.index', ['itens' => $itens]);
    }

    public function create()
    {
        return view('estoque.create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $request->validate([
            // Garante que o nome é único para este usuário
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('item_estoques')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'nullable|string',
        ]);

        $item = new ItemEstoque();
        $item->nome = $request->nome;
        $item->quantidade = $request->quantidade;
        $item->descricao = $request->descricao;
        $item->user_id = $userId;
        $item->save();

        return redirect()->route('estoque.index')->with('success', 'Item "' . $item->nome . '" adicionado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemEstoque  $estoque (Laravel faz o Route Model Binding)
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function edit(ItemEstoque $estoque) // Nome do parâmetro deve coincidir com o da rota resource ('estoque')
    {
        // Verifica se o item pertence ao usuário logado
        if ($estoque->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.'); // Ou redirecionar com erro
        }
        return view('estoque.edit', ['item' => $estoque]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemEstoque  $estoque
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ItemEstoque $estoque)
    {
        $userId = Auth::id();

        // Verifica permissão
        if ($estoque->user_id !== $userId) {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            // Garante que o nome é único para este usuário, ignorando o próprio item atual
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('item_estoques')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                })->ignore($estoque->id),
            ],
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'nullable|string',
        ]);

        $estoque->nome = $request->nome;
        $estoque->quantidade = $request->quantidade;
        $estoque->descricao = $request->descricao;
        $estoque->save();

        return redirect()->route('estoque.index')->with('success', 'Item "' . $estoque->nome . '" atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemEstoque  $estoque
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ItemEstoque $estoque)
    {
        // Verifica permissão
        if ($estoque->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $nomeItem = $estoque->nome; // Guarda o nome antes de deletar
        $estoque->delete();

        return redirect()->route('estoque.index')->with('success', 'Item "' . $nomeItem . '" excluído com sucesso!');
    }
}