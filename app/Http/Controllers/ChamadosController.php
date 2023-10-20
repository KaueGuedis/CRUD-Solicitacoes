<?php

namespace App\Http\Controllers;

use App\Models\Chamados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class ChamadosController extends Controller
{

    public function novoChamado()
    {
        $usuarioLogado = Auth::user();
        if(empty($usuarioLogado)){
            return view('index');
        } else if($usuarioLogado['tipo_usuario'] != 'cliente'){
            return view("dashboard", ['usuarioLogado' => $usuarioLogado, 'erro' => 'Colaborador não pode criar chamado']);
        }

        return view('chamado');

    }

    public function salvarChamado(Request $request)
    {
        try {

            $dadosChamado = $request->all();

            if(empty($dadosChamado['titulo'])){
                return back()->withErrors([
                    'titulo' => 'Preencha o Título do Chamado corretamente',
                ])->withInput($dadosChamado);
            }

            if(empty($dadosChamado['descricao'])){
                return back()->withErrors([
                    'descricao' => 'Preencha o descrição do Chamado corretamente',
                ])->withInput($dadosChamado);
            }

            if($request->hasFile('anexo')){
                $filenameWithExt = $request->file('anexo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('anexo')->getClientOriginalExtension();
                $dadosChamado['anexo'] = $filename.'_'.time().'.'.$extension;
                $request->file('anexo')->storeAs('public', $dadosChamado['anexo']);
            } else {
                $dadosChamado['anexo'] = NULL;
            }

            $dadosChamado['criacao'] = date('Y-m-d H:i:s');

            $usuarioLogado = Auth::user();
            if(empty($usuarioLogado)){
                return view('index');
            } else if($usuarioLogado['tipo_usuario'] != 'cliente'){
                return view("dashboard", ['usuarioLogado' => $usuarioLogado, 'erro' => 'Colaborador não pode criar chamado']);
            } else {
                $salvaChamado = Chamados::create($dadosChamado);
                if(!empty($salvaChamado)){
                    return redirect()->intended('dashboard');
                }
                return back()->withErrors([
                    'descricao' => 'Erro ao salvar chamado',
                ])->withInput($dadosChamado);
            }

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

    public function visualizarChamado(Request $request)
    {
        try {

            $usuarioLogado = Auth::user();
            if(empty($usuarioLogado)){
                return view('index');
            }

            $chamado = Chamados::findOrFail($request->id);
            if(!empty($chamado)){
                return view('chamado', ['dadosChamado' => $chamado]);
            }

        } catch (\Exception $e) {

            return response()->json([

                'status' => 'erro',
                'msg' => $e->getMessage(),
                'debug' => "Erro: " . $e->getMessage(), ", Linha: " => $e->getLine(), ", Arquivo: " => $e->getFile()

            ], 500);

        }
    }

    public function baixarArquivo(Request $request)
    {
        try {
            return Storage::disk('public')->download($request->anexo);
        } catch (\Exception $e) {
            Session(['mensagem_aviso' => "Arquivo não encontrado"]);
        }
    }

    public function atualizaChamado(Request $request)
    {
        try {

            $dadosChamado = $request->all();

            if(empty($dadosChamado['resposta'])){
                return back()->withErrors([
                    'resposta' => 'Preencha a resposta corretamente',
                ])->withInput($dadosChamado);
            }
            
            $salvaChamado = Chamados::where('id', $dadosChamado['id'])->update(['status' => $dadosChamado['atualiza_chamado'], 'resposta' => $dadosChamado['resposta']]);

            if($salvaChamado){
                Session(['mensagem_sucesso' => "Chamado atualizado com sucesso"]);
                return redirect()->intended('dashboard');
            }

            Session(['mensagem_aviso' => "Erro ao atualizar chamado"]);
            return back()->withInput($dadosChamado);

        } catch (\Exception $e) {

            return response()->json([

                'status' => 'erro',
                'msg' => $e->getMessage(),
                'debug' => "Erro: " . $e->getMessage(), ", Linha: " => $e->getLine(), ", Arquivo: " => $e->getFile()

            ], 500);

        }
    }
    
}
