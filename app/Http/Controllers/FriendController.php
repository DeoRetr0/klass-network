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
        return view('friends.index')
            ->with('friends', $friends)
            ->with('friendRequests', $friendRequests);
    }
    public static function getFriends($email)
    {
        $friends = Auth::user()->friends();
        $user = User::where('email', $email)->first();
        if (!$user){
            abort(404);
        }
        return view('profile.friends')
            ->with('friends', $friends)
            ->with('user', $user);
    }

    /**
     *  SEND  a friend request
     */
    public function getAdd( $email )
    {
        // get the requested user's DB object
        $user = User::where('email', $email)->first();

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
                ->route('profile.index', ['email' => $email])
                ->with('info', 'Pedido de amizade pendente!');
        }

        // check if they are already friends
        if ( Auth::user()->isFriendsWith($user) ) {
            return redirect()
                ->route('profile.index', ['email' => $email])
                ->with('info', 'Vocês já são amigos!');
        }

        // now create the friend request
        Auth::user()->addFriend( $user );

        return redirect()
            ->route('profile.index', ['email' => $email])
            ->with('info', 'Pedido de amizade enviado!');
    }

    /**
     *  ACCEPT  a friend request
     */
    public function getAccept($email)
    {
        // get the requested user's DB object
        $user = User::where('email', $email)->first();

        // check if there was a request pending
        if (!$user) {
            return redirect()
                ->route('home')
                ->with('info', 'Nenhum pedido de amizade encontrado.');
        }

        // check if there IS a friend request between the two
        if ( !Auth::user()->hasFriendRequestReceived($user) ) {
            return redirect()
                ->route('profile.index', ['email' => $email]);
        }

        // check if they are already friends
        if ( Auth::user()->isFriendsWith($user) ) {
            return redirect()
                ->route('profile.index', ['email' => $email])
                ->with('info', 'Vocês já são amigos!');
        }

        // now accept the friend request
        Auth::user()->acceptFriendRequest( $user );

        return back()
            ->with('info', 'Pedido de amizade aceito!');
    }


}
