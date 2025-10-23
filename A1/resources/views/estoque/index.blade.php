@extends('layouts.app') {{-- Usa o layout padrão com menu, etc --}}

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Meu Estoque</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('estoque.create') }}" class="btn btn-primary">Adicionar Novo Item</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Descrição</th>
                        <th>Adicionado em</th>
                        <th>Ações</th> {{-- Coluna para botões --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($itens as $item) {{-- Loop nos itens passados pelo Controller --}}
                        <tr>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->quantidade }}</td>
                            <td>{{ $item->descricao ?? '-' }}</td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td> {{-- Data formatada --}}
                            <td>
                                {{-- Adicione botões de Editar e Excluir aqui quando implementar as rotas/métodos --}}
                                {{-- <a href="{{ route('estoque.edit', $item->id) }}" class="btn btn-sm btn-warning">Editar</a> --}}
                                {{-- <form action="{{ route('estoque.destroy', $item->id) }}" method="POST" style="display:inline;"> --}}
                                    {{-- @csrf --}}
                                    {{-- @method('DELETE') --}}
                                    {{-- <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button> --}}
                                {{-- </form> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Nenhum item cadastrado no estoque ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection