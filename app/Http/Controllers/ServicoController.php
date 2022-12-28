<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        $data = Servico::simplePaginate(10);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = Servico::create(
            [
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao'),
                'valor' => $request->input('valor'),
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
        $data = Servico::where('id', $id)->first(['nome', 'descricao', 'valor', 'created_at']);

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
        $data = Servico::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $dataRequest = [
            'nome' => $request->input('nome'),
            'descricao' => $request->input('descricao'),
            'valor' => $request->input('valor'),
        ];
        $data->update($dataRequest);

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = Servico::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $resultDelete = Servico::destroy($data->id);

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
