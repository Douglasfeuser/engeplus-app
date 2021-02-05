<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\VendaController;
use App\Http\Livewire\Vendas;
use App\Http\Livewire\Produtos;
use App\Http\Livewire\Servicos;

// Route::resource('vendas', VendaController::class);

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

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('vendas', Vendas::class)->name('vendas');
Route::middleware(['auth:sanctum', 'verified'])->get('produtos', Produtos::class)->name('produtos');
Route::middleware(['auth:sanctum', 'verified'])->get('servicos', Servicos::class)->name('servicos');