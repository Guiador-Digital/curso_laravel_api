<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $data = OrdemServico::simplePaginate(10);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = OrdemServico::create(
            [
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao'),
                'valor' => $request->input('valor'),
                'servico_id' => $request->input('servico_id'),
                'cliente_id' => $request->input('cliente_id'),
            ]
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

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = OrdemServico::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $dataRequest = [
            'nome' => $request->input('nome'),
            'descricao' => $request->input('descricao'),
            'valor' => $request->input('valor'),
            'servico_id' => $request->input('servico_id'),
            'cliente_id' => $request->input('cliente_id'),
        ];
        $data->update($dataRequest);

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
