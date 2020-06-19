<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getResults(Request $request){

        $query = $request->input('query');
        if(!$query){
            return redirect()->route('home');
        }
        $users = User::where(DB::raw("CONCAT(nome,' ', sobrenome)"), 'LIKE', "%{$query}%")
            ->orWhere('nome', 'LIKE', "%{$query}%")
            ->get();
        $friends = Auth::user()->friends();
        $friendRequests = Auth::user()->friendRequests();

        return view('search.Buscar')
            ->with('friends', $friends)
            ->with('friendRequests', $friendRequests)
            ->with('users', $users);
    }
}
