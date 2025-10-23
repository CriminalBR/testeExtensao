@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm"> {{-- Adicionado shadow-sm para um leve sombreamento --}}
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    {{-- Bloco para exibir a mensagem de status (ex: após cadastro) --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                           <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                        </div>
                    @endif
                    {{-- Fim do bloco de status --}}

                    {{-- Exibe mensagem de erro de login padrão, se houver --}}
                    @error('email')
                         <div class="alert alert-danger mb-3" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $message }}
                         </div>
                    @enderror
                     @error('password')
                         {{-- Geralmente o erro de senha incorreta é associado ao email,
                              mas caso haja validação específica na senha, descomente:
                         <div class="alert alert-danger mb-3" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $message }}
                         </div>
                         --}}
                    @enderror


                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                {{-- Removido is-invalid daqui para mostrar erro geral acima --}}
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                {{-- Erro específico removido daqui
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                {{-- Removido is-invalid daqui --}}
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                 {{-- Erro específico removido daqui
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection