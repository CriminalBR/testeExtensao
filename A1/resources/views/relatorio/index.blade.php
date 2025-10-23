@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Relatório de Estoque</h1>

    <div class="row g-4 mb-4">
        {{-- Card Total de Itens Distintos --}}
        <div class="col-md-6 col-lg-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="bi bi-box-seam me-2"></i>Itens Distintos</h5>
                    <p class="card-text fs-2 fw-bold">{{ $totalItensDistintos }}</p>
                </div>
            </div>
        </div>

        {{-- Card Quantidade Total --}}
        <div class="col-md-6 col-lg-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="bi bi-boxes me-2"></i>Unidades Totais</h5>
                    <p class="card-text fs-2 fw-bold">{{ $quantidadeTotal }}</p>
                </div>
            </div>
        </div>

        {{-- Card Itens com Quantidade Baixa --}}
        <div class="col-md-6 col-lg-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-warning"><i class="bi bi-exclamation-triangle me-2"></i>Itens Baixos (&lt; {{ $limiteQuantidadeBaixa }})</h5>
                    <p class="card-text fs-2 fw-bold">{{ $itensQuantidadeBaixa->count() }}</p>
                </div>
                 @if($itensQuantidadeBaixa->count() > 0)
                 <div class="card-footer bg-transparent border-0">
                     <a href="#itens-baixos" class="btn btn-sm btn-outline-warning">Ver Itens</a>
                 </div>
                 @endif
            </div>
        </div>
         {{-- Placeholder para outro card, se necessário --}}
         <div class="col-md-6 col-lg-3">
            {{-- Pode adicionar outro card aqui (ex: Valor total estimado, se adicionar preço) --}}
         </div>
    </div>

    {{-- Seção Itens com Quantidade Baixa --}}
    @if($itensQuantidadeBaixa->count() > 0)
        <div class="card shadow-sm mb-4" id="itens-baixos">
            <div class="card-header bg-warning text-dark">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Itens com Quantidade Baixa (Menos de {{ $limiteQuantidadeBaixa }} unidades)
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th class="text-center">Quantidade Atual</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itensQuantidadeBaixa as $item)
                                <tr>
                                    <td>{{ $item->nome }}</td>
                                    <td class="text-center text-danger fw-bold">{{ $item->quantidade }}</td>
                                    <td>{{ $item->descricao ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    {{-- Seção Últimos Itens Adicionados --}}
    <div class="card shadow-sm">
        <div class="card-header bg-info text-dark">
           <i class="bi bi-clock-history me-2"></i> Últimos 5 Itens Adicionados
        </div>
        <div class="card-body">
            @if($ultimosItensAdicionados->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th class="text-center">Quantidade</th>
                                <th>Adicionado em</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ultimosItensAdicionados as $item)
                                <tr>
                                    <td>{{ $item->nome }}</td>
                                    <td class="text-center">{{ $item->quantidade }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $item->descricao ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
             @else
                <p class="text-muted">Nenhum item adicionado recentemente.</p>
             @endif
        </div>
    </div>

</div>
@endsection