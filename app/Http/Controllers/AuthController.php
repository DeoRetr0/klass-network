<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function getSignup(){
        return view('auth.signup');
    }

    public function postSignup(Request $request){
        $this->validate($request,[
           'email'=>'required|unique:users|email|max:30',
            'username'=>'required|unique:users|alpha|max:10',
            'nome'=>'required|alpha|max:30',
            'sobrenome'=>'required|alpha|max:30',
            'password'=>'required|min:8',
        ]);
        User::create([
            'email'=>$request->input('email'),
            'nome'=>$request->input('nome'),
            'username'=>$request->input('username'),
            'sobrenome'=>$request->input('sobrenome'),
            'faculdade'=>$request->input('faculdade'),
            'curso'=>$request->input('curso'),
            'dataNascimento'=>$request->input('dataNascimento'),
            'password'=>bcrypt($request->input('password')),
        ]);

        return redirect()
            ->route('home')
            ->with('info', 'Sua conta foi criada e você pode acessar o site!');
    }

    public function getLogin(){
        return view('auth.login');
    }
    public function postLogin(Request $request){
        $this->validate($request,[
           'email'=>'required',
            'password' =>'required',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('rememberMe'))){
            return redirect()->route('home')->with('info', 'Bem vindo!');
        }
        return redirect()->back()->with('info', 'Erro ao validar informações');

    }

    public function getSignout(){
        Auth::logout();
        return redirect()->route('home');
    }

}
