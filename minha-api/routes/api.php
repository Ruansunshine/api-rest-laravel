<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/status', function () {
    return response()->json(['message' => 'API esta funcionando']);
});
Route::get('getProdutos', [ProdutoController::class, 'index']);
Route::get('buscarProduto/{id}', [ProdutoController::class, 'show']);
Route::put('atualizarProduto/{id}', [ProdutoController::class, 'update']);
Route::delete('deletarProduto/{id}', [ProdutoController::class, 'destroy']);
Route::patch('atualizarCampoProduto/{id}', [ProdutoController::class, 'update']);

