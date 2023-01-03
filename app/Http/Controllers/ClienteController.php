<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Cliente::class);

        $data = Cliente::with('endereco')->withCount('ordens_servicos')->simplePaginate(10);
        $data->makeHidden([
            'possui_os_no_mes_vigente'
        ]);

        return response()->json($data);
    }

    public function store(StoreClienteRequest $request)
    {
        $this->authorize('create', Cliente::class);

        $validated = $request->validated();

        $validated['password'] = bcrypt($validated['password']);

        $data = Cliente::create($validated);

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao inserir o registro'
            ], 400);
        }

        return response()->json([
            'data' => $data
        ], 201);
    }

    public function show($id)
    {
        $data = Cliente::where('id', $id)
            ->with([
                'endereco',
                'ordens_servicos' => function ($query) {
                    $query->select('id', 'nome', 'valor', 'cliente_id');
                    $query->where('valor', '>=', 100);
                }
            ])
            ->first(['id', 'nome', 'empresa', 'telefone', 'email', 'data_nascimento', 'created_at']);

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $this->authorize('view', $data);

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(UpdateClienteRequest $request, $id)
    {
        $validated = $request->validated();

        $data = Cliente::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $this->authorize('update', $data);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $data->update($validated);

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = Cliente::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $this->authorize('delete', $data);

        $resultDelete = Cliente::destroy($data->id);

        if ($resultDelete == 0) {
            return response()->json([
                'msg' => 'Erro ao excluir o registro'
            ], 400);
        }

        return response()->json([
            'msg' => 'Registro excluído com sucesso'
        ]);
    }
}
