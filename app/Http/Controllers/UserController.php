<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view("novo_usuario");
    }

    public function novoUsuario(Request $request)
    {
        try {

            $dadosUsuario = $request->all();

            if(empty($dadosUsuario['name'])){
                return back()->withErrors([
                    'name' => 'Preencha o Nome Completo corretamente',
                ])->withInput($dadosUsuario);
            }

            if(empty($dadosUsuario['email'])){
                return back()->withErrors([
                    'email' => 'Preencha o E-mail corretamente',
                ])->withInput($dadosUsuario);
            } else {
                $userEmail = User::where('email', $dadosUsuario['email'])->first();
                if(!empty($userEmail)){
                    return back()->withErrors([
                        'email' => 'E-mail já em uso',
                    ])->withInput($dadosUsuario);
                }
            }

            if(strlen($dadosUsuario['cpf']) > 14 || strlen($dadosUsuario['cpf']) < 14){
                return back()->withErrors([
                    'cpf' => 'Preencha o CPF corretamente',
                ])->withInput($dadosUsuario);
            } else {
                $dadosUsuario['cpf'] = str_replace(['-', '.'], '', $dadosUsuario['cpf']);
                $userCpf = User::where('cpf', $dadosUsuario['cpf'])->first();
                if(!empty($userCpf)){
                    return back()->withErrors([
                        'cpf' => 'CPF já em uso',
                    ])->withInput($dadosUsuario);
                }
            }

            if(empty($dadosUsuario['tipo_usuario'])){
                return back()->withErrors([
                    'tipo_usuario' => 'Preencha o tipo do Usuario corretamente',
                ])->withInput($dadosUsuario);
            }

            if(empty($dadosUsuario['password']) || empty($dadosUsuario['password_repeat'])){
                return back()->withErrors([
                    'tipo_usuario' => 'Preencha a senha corretamente',
                ])->withInput($dadosUsuario);
            }

            if($dadosUsuario['password'] !== $dadosUsuario['password_repeat']){
                return back()->withErrors([
                    'password_repeat' => 'A senhas não se coincidem.',
                ])->withInput($dadosUsuario);
            } else {
                unset($dadosUsuario['password_repeat']);
                $dadosUsuario['password'] = Hash::make($dadosUsuario['password']);
            }

            User::create($dadosUsuario);
            Session(['mensagem_sucesso' => "Usuário cadastrado com sucesso"]);
            return view("index");

        } catch (\Exception $exception) {
            Session(['mensagem_aviso' => $exception->getMessage()]);
            return view("index");
            // abort(500,$exception->getMessage() . " - " . $exception->getLine());
        }
    }
}
