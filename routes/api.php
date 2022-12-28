<?php

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

Route::resource('users', UserController::class);
