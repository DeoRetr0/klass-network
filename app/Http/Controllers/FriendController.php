<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public static function getIndex()
    {
        $friends = Auth::user()->friends();
        $friendRequests = Auth::user()->friendRequests();
        return view('friends.Solicitacoes')
            ->with('friends', $friends)
            ->with('friendRequests', $friendRequests);
    }
    public static function getFriends($username)
    {
        $friends = Auth::user()->friends();
        $friendRequests = Auth::user()->friendRequests();
        $user = User::where('username', $username)->first();
        if (!$user){
            abort(404);
        }
        return view('profile.Followers')
            ->with('friends', $friends)
            ->with('user', $user)
            ->with('friendRequests', $friendRequests);
    }

    /**
     *  SEND  a friend request
     */
    public function getAdd( $username )
    {
        // get the requested user's DB object
        $user = User::where('username', $username)->first();

        // A user can't send himself a request...
        if ( Auth::user()->id === $user->id ) {
            return redirect()
                ->route('home')
                ->with('info', 'Você não pode se adicionar!');
        }

        // check if there was a request pending
        if (!$user) {
            return redirect()
                ->route('home')
                ->with('info', 'Nenhum pedido de amizade encontrado.');
        }

        // check if there exists already a friend request between the two
        if ( Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()) ) {
            return redirect()
                ->route('profile.Perfil', ['username' => $username])
                ->with('info', 'Pedido de amizade pendente!');
        }

        // check if they are already friends
        if ( Auth::user()->isFriendsWith($user) ) {
            return redirect()
                ->route('profile.Perfil', ['username' => $username])
                ->with('info', 'Vocês já são amigos!');
        }

        // now create the friend request
        Auth::user()->addFriend( $user );

        return redirect()
            ->route('profile.Perfil', ['username' => $username])
            ->with('info', 'Pedido de amizade enviado!');
    }

    /**
     *  ACCEPT  a friend request
     */
    public function getAccept($username)
    {
        // get the requested user's DB object
        $user = User::where('username', $username)->first();

        // check if there was a request pending
        if (!$user) {
            return redirect()
                ->route('home')
                ->with('info', 'Nenhum pedido de amizade encontrado.');
        }

        // check if there IS a friend request between the two
        if ( !Auth::user()->hasFriendRequestReceived($user) ) {
            return redirect()
                ->route('profile.Perfil', ['username' => $username]);
        }

        // check if they are already friends
        if ( Auth::user()->isFriendsWith($user) ) {
            return redirect()
                ->route('profile.Perfil', ['username' => $username])
                ->with('info', 'Vocês já são amigos!');
        }

        // now accept the friend request
        Auth::user()->acceptFriendRequest( $user );

        return back()
            ->with('info', 'Pedido de amizade aceito!');
    }

    public function postDelete ($username){
        $user = User::where('username', $username)->first();
        if (!Auth::user()->isFriendsWith($user) ) {
            return redirect()->back();
        }
        Auth::user()->deleteFriend($user);
        return redirect()->back()->with('info', 'Amizade desfeita');
    }
}
