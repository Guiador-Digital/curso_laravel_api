<?php

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
    Route::get('/', function () {
        return response()->json([
            'msg' => 'Rota de listagem de usuários'
        ]);
    });

    Route::post('/', function () {
        return response()->json([
            'msg' => 'Rota de inserção de usuário'
        ]);
    });

    Route::get('/{user}', function () {
        return response()->json([
            'msg' => 'Rota de listagem de 1 usuário'
        ]);
    });

    Route::put('/{user}', function () {
        return response()->json([
            'msg' => 'Rota de atualização de usuário'
        ]);
    });

    Route::delete('/{user}', function () {
        return response()->json([
            'msg' => 'Rota de exclusão de usuário'
        ]);
    });
});
