<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Testing\TestResponse;

class LoginController extends Controller
{
    public function index()
    {
        return view("index");
    }

    public function authenticate(Request $request)
    {
        try {

            if(empty($request->password)){
                return back()->withErrors([
                    'password' => 'Preencha a senha',
                ]);
            }

            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }

            return back()->withErrors([
                'email' => 'Informações inválidas ou usuário inexistente',
            ])->onlyInput('email');

        } catch (\Exception $e) {

            return response()->json([

                'status' => 'erro',
                'msg' => $e->getMessage(),
                'debug' => "Erro: " . $e->getMessage(), ", Linha: " => $e->getLine(), ", Arquivo: " => $e->getFile()

            ], 500);

        }

    }

    public function dashboard()
    {
        $usuarioLogado = Auth::user();
        if(empty($usuarioLogado)){
            return view('index');
        }

        return view("dashboard", ['usuarioLogado' => $usuarioLogado]);
    }

    public function logout()
    {
        Auth::logout();
        return view('index');
    }
}
