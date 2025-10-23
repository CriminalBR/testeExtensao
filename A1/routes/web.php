<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ItemEstoqueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RelatorioController; // Adicionar o controller do relatório

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(); // Mantém as rotas de autenticação (login, registro, etc.)

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Agrupar rotas que exigem autenticação
Route::middleware(['auth'])->group(function () {
    // Rotas para o CRUD de Estoque (exceto 'show', que não foi implementada)
    Route::resource('estoque', ItemEstoqueController::class)->except(['show']);

    // Rota para o Relatório
    Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
});