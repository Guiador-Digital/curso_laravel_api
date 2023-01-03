<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdemServicoRequest;
use App\Http\Requests\UpdateOrdemServicoRequest;
use App\Models\OrdemServico;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', OrdemServico::class);

        $data = OrdemServico::simplePaginate(10);

        return response()->json($data);
    }

    public function store(StoreOrdemServicoRequest $request)
    {
        $this->authorize('create', OrdemServico::class);

        $validated = $request->validated();

        $data = OrdemServico::create(
            $validated
        );

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
        $data = OrdemServico::where('id', $id)->first([
            'nome',
            'descricao',
            'valor',
            'servico_id',
            'cliente_id', 'created_at'
        ]);

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

    public function update(UpdateOrdemServicoRequest $request, $id)
    {
        $validated = $request->validated();

        $data = OrdemServico::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $this->authorize('update', $data);

        $data->update($validated);

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = OrdemServico::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $this->authorize('delete', $data);

        $resultDelete = OrdemServico::destroy($data->id);

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
