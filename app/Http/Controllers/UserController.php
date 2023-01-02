<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $data = User::simplePaginate(10);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $validated['password'] = bcrypt($validated['password']);

        $data = User::create(
            $validated
        );

        if ($data == null) {
            return response()->json([
                'msg' => 'Houve um erro ao inserir este registro'
            ], 400);
        }


        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', User::class);

        $user = User::where('id', $id)->first(['id', 'name', 'email', 'created_at']);

        if ($user == null) {
            return response()->json([
                'msg' => 'Houve um erro ao buscar este registro'
            ], 404);
        }

        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorize('update', User::class);

        $validated = $request->validated();

        $user = User::where('id', $id)->first();

        if ($user == null) {
            return response()->json([
                'msg' => 'Não foi possível encontrar este registro'
            ], 404);
        }

        $user->update($validated);

        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);

        $user = User::where('id', $id)->first();

        if ($user == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar este registro'
            ], 404);
        }

        $data = User::destroy($user->id);

        if ($data == 0) {
            return response()->json([
                'msg' => 'Erro ao excluir este registro'
            ], 400);
        }

        return response()->json([
            'msg' => 'Registro apagado com sucesso'
        ]);
    }

    public function relatorioMensal()
    {
        return response()->json([
            'msg' => 'Relatório mensal'
        ]);
    }
}
