<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rotas de usuários

Route::group([
    'prefix' => 'users'
], function () {
    Route::get('/relatorio-mensal', [UserController::class, 'relatorioMensal']);
});

Route::apiResource('users', UserController::class);

// /clientes
Route::apiResource('clientes', ClienteController::class);
Route::group([
    'prefix' => 'clientes'
], function () {
    // /clientes/enderecos
    Route::apiResource('enderecos', ClienteController::class);
});

// Serviços
Route::apiResource('servicos', ServicoController::class);

// Ordem de serviços
Route::apiResource('ordens-servicos', OrdemServicoController::class);
