<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Vendas;
use App\Http\Livewire\Produtos;
use App\Http\Livewire\Comissoes;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/', Comissoes::class)->name('comissoes');
Route::middleware(['auth:sanctum', 'verified'])->get('/comissoes', Comissoes::class)->name('comissoes');

Route::middleware(['auth:sanctum', 'verified'])->get('vendas', Vendas::class)->name('vendas');
Route::middleware(['auth:sanctum', 'verified'])->get('produtos', Produtos::class)->name('produtos');
