<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteEnderecoRequest;
use App\Http\Requests\UpdateClienteEnderecoRequest;
use App\Models\ClienteEndereco;
use Illuminate\Http\Request;

class ClienteEnderecoController extends Controller
{
    public function index()
    {
        $data = ClienteEndereco::simplePaginate(10);

        return response()->json($data);
    }

    public function store(StoreClienteEnderecoRequest $request)
    {

        $validated = $request->validated();

        $data = ClienteEndereco::create(
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
        $data = ClienteEndereco::where('id', $id)->first([
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

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(UpdateClienteEnderecoRequest $request, $id)
    {
        $validated = $request->validated();

        $data = ClienteEndereco::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $data->update($validated);

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = ClienteEndereco::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $resultDelete = ClienteEndereco::destroy($data->id);

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
