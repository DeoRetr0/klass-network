<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::check()){
            $status = Status::notReply(function($query){
                return $query->where('user_id', Auth::user()->id)
                    ->orWhereIn('user_id', Auth::user()
                    ->friends()->pluck('id'));

            })->orderBy('created_at', 'desc')
            ->paginate(10);
            $friends = Auth::user()->friends();
            $friendRequests = Auth::user()->friendRequests();

            return view('timeline.Inicio')
                ->with('status', $status)
                ->with('friends', $friends)
                ->with('friendRequests', $friendRequests)
                ->with('authUserIsFriend', Auth::user()->isFriendsWith(Auth::user()));
        }

        return view('home');
    }
}
