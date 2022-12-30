<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteEnderecoController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/user'
], function () {
    Route::post('login', [AuthUserController::class, 'login']);
    Route::post('logout', [AuthUserController::class, 'logout']);
    Route::post('refresh', [AuthUserController::class, 'refresh']);
    Route::post('me', [AuthUserController::class, 'me']);
});

Route::apiResource('users', UserController::class);

// /clientes
Route::apiResource('clientes', ClienteController::class);
Route::apiResource('clientes-enderecos', ClienteEnderecoController::class);

// Serviços
Route::apiResource('servicos', ServicoController::class);

// Ordem de serviços
Route::apiResource('ordens-servicos', OrdemServicoController::class);
