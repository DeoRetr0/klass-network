<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile($email){
        $user = User::where('email', $email)->first();
        if (!$user){
            abort(404);
        }
        return view('profile.index')
            ->with('user', $user);
    }

    public function getEdit(){
        return view('profile.edit');
    }

    public function postEdit(Request $request){
        $this->validate($request, [
            'nome'=>'alpha|max:30',
            'sobrenome'=>'alpha|max:30',
        ]);

        Auth::user()->update([
            'nome' => $request->input('nome'),
            'sobrenome' => $request->input('sobrenome'),
            'localizacao'=>$request->input('localizacao'),
            'faculdade'=>$request->input('faculdade'),
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('info', 'Seu perfil foi atualizado!');
    }
}
