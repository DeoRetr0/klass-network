<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function getProfile($username){
        $user = User::where('username', $username)->first();
        if (!$user){
            abort(404);
        }
        $status = $user->status()->notReply()->get();
        $friends = Auth::user()->friends();
        $friendRequests = Auth::user()->friendRequests();

        return view('profile.Perfil')
            ->with('user', $user)
            ->with('username', $username)
            ->with('friends', $friends)
            ->with('friendRequests', $friendRequests)
            ->with('status', $status)
            ->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
    }

    public function atualizarImagem(Request $request){
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/storage/uploads/avatars/'.$filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
            return redirect()
                ->back()
                ->with('info', 'Sua imagem foi atualizada!');
        }
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
            'curso'=>$request->input('curso'),
            'nasceuEm'=>$request->input('nasceuEm'),
            'trabalho'=>$request->input('trabalho'),
            'relacionamento'=>$request->input('relacionamento'),
            'sobre'=>$request->input('sobre')
        ]);

        return redirect()
            ->route('profile.Perfil', ['username'=>Auth::user()->username])
            ->with('info', 'Seu perfil foi atualizado!');
    }

    public function getConfig(){
        $friends = Auth::user()->friends();
        $friendRequests = Auth::user()->friendRequests();
        return view('config.Config')
            ->with('friends', $friends)
            ->with('friendRequests', $friendRequests);
    }
}
