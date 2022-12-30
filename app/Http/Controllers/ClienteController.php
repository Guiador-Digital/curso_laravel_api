<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $data = Cliente::with('endereco')->withCount('ordens_servicos')->simplePaginate(10);
        $data->makeHidden([
            'possui_os_no_mes_vigente'
        ]);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = Cliente::create(
            [
                'nome' => $request->input('nome'),
                'empresa' => $request->input('empresa'),
                'telefone' => $request->input('telefone'),
                'email' => $request->input('email'),
                'data_nascimento' => $request->input('data_nascimento'),
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

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Cliente::where('id', $id)->first();

        if ($data == null) {
            return response()->json([
                'msg' => 'Erro ao encontrar o registro'
            ], 404);
        }

        $dataRequest = [
            'nome' => $request->input('nome'),
            'empresa' => $request->input('empresa'),
            'telefone' => $request->input('telefone'),
            'email' => $request->input('email'),
            'data_nascimento' => $request->input('data_nascimento'),
        ];
        $data->update($dataRequest);

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
