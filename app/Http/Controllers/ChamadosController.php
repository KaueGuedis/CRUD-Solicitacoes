<?php

namespace App\Http\Controllers;

use App\Models\Chamados;
use Illuminate\Http\Request;

class ChamadosController extends Controller
{

    public function salvarChamado(Request $request)
    {
        try {

            $dadosChamado = $request->all();
            dd($dadosChamado, $request->all());

        } catch (\Exception $e) {

            return response()->json([

                'status' => 'erro',
                'msg' => $e->getMessage(),
                'debug' => "Erro: " . $e->getMessage(), ", Linha: " => $e->getLine(), ", Arquivo: " => $e->getFile()

            ], 500);

        }
    }

    public function listagemChamados(Request $request)
    {
        try {
            
            $limit = !empty($request->params['limit']) ? $request->params['limit'] : 10;
            $offset = !empty($request->params['offset']) ? $request->params['offset'] : 0;
            
            $sort = 'id';
            $order = 'desc';
            $search = null;
            
            if (!empty($request->params['sort'])) {
                $sort = $request->params['sort'];
            }
            
            if(!empty($request->params['order'])){
                $order = $request->params['order'];
            }

            if(!empty($request->params['search'])){
                $search = $request->params['search'];
            }

            return Chamados::listagem($limit, $offset, $search, $sort, $order);

        } catch (\Exception $e) {

            return response()->json([

                'status' => 'erro',
                'msg' => $e->getMessage(),
                'debug' => "Erro: " . $e->getMessage(), ", Linha: " => $e->getLine(), ", Arquivo: " => $e->getFile()

            ], 500);

        }
    }
    
}
