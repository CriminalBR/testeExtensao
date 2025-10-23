<?php

namespace App\Http\Controllers;

use App\Models\ItemEstoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Importar DB Facade

class RelatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protege o controller
    }

    /**
     * Exibe a página de relatório.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();

        // 1. Total de itens distintos
        $totalItensDistintos = ItemEstoque::where('user_id', $userId)->count();

        // 2. Quantidade total de todos os itens (soma das quantidades)
        $quantidadeTotal = ItemEstoque::where('user_id', $userId)->sum('quantidade');

        // 3. Itens com quantidade baixa (exemplo: menos que 5 unidades)
        $limiteQuantidadeBaixa = 5;
        $itensQuantidadeBaixa = ItemEstoque::where('user_id', $userId)
                                           ->where('quantidade', '<', $limiteQuantidadeBaixa)
                                           ->orderBy('quantidade', 'asc')
                                           ->get();

        // 4. Últimos 5 itens adicionados
        $ultimosItensAdicionados = ItemEstoque::where('user_id', $userId)
                                              ->latest() // Ordena por created_at descendente
                                              ->take(5)
                                              ->get();

        // Passa os dados para a view
        return view('relatorio.index', compact(
            'totalItensDistintos',
            'quantidadeTotal',
            'itensQuantidadeBaixa',
            'limiteQuantidadeBaixa',
            'ultimosItensAdicionados'
        ));
    }
}