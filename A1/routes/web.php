<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- Linha adicionada aqui
use App\Http\Controllers\ItemEstoqueController; // Verifique se esta linha já existe
use App\Http\Controllers\HomeController; // Adicione esta linha também, se não existir

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(); // Esta linha agora deve funcionar corretamente

Route::resource('estoque', ItemEstoqueController::class)->except(['show']);

Route::get('/home', [HomeController::class, 'index'])->name('home'); // Também é bom usar ::class aqui