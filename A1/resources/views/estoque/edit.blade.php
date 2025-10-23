@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">{{ __('Editar Item do Estoque') }}</div>

                <div class="card-body">
                    {{-- Exibe erros de validação --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('estoque.update', $item->id) }}">
                        @csrf
                        @method('PUT') {{-- Método HTTP para atualização --}}

                        <div class="row mb-3">
                            <label for="nome" class="col-md-4 col-form-label text-md-end">{{ __('Nome do Item') }} <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                {{-- Usa o valor antigo (old) ou o valor atual do item --}}
                                <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome', $item->nome) }}" required autocomplete="nome" autofocus>
                                @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantidade" class="col-md-4 col-form-label text-md-end">{{ __('Quantidade') }} <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="quantidade" type="number" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{ old('quantidade', $item->quantidade) }}" required min="0">
                                @error('quantidade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="descricao" class="col-md-4 col-form-label text-md-end">{{ __('Descrição (Opcional)') }}</label>
                            <div class="col-md-6">
                                <textarea id="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" rows="3">{{ old('descricao', $item->descricao) }}</textarea>
                                @error('descricao')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> {{ __('Salvar Alterações') }}
                                </button>
                                <a href="{{ route('estoque.index') }}" class="btn btn-secondary">
                                     <i class="bi bi-x-circle"></i> {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection