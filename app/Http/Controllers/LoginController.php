<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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

        } catch (\Exception $exception) {
            abort(500,$exception->getMessage() . " - " . $exception->getLine());
        }

    }

    public function dashboard()
    {
        return view("dashboard");
    }

}
