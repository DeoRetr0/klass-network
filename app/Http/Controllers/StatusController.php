<?php


namespace App\Http\Controllers;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like;


class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        $this->validate($request,[
            'status' => 'required|max:250'
        ]);
        Auth::user()->status()->create([
            'body' => $request->input('status'),
        ]);

        return redirect()->route('home')
            ->with('info', 'status postado');
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request,[
           "reply-{$statusId}" => 'required|max:1000',
        ],[
            'required' => 'Você deve escrever algo primeiro!'
        ]);

        $status = Status::notReply()->find($statusId);

        if (!$status){
            return redirect()->route('home')
                ->with('info', 'O post não existe mais.');
        }
        if (!Auth::user()->isFriendsWith($status->user)
            && Auth::user()->id !== $status->user->id){
            return redirect()->route('home');
        }

        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}"),
            'user_id' => auth()->id()
        ])->user()->associate(Auth::user());

        $status->replies()->save($reply);

        return redirect()->back();
    }

    public function getLike($statusId)
    {
        $status = Status::find($statusId);

        if (!$status){
            return redirect()->status('home');
        }
        if (!Auth::user()->isFriendsWith($status->user)){
            return redirect()->route('home');
        }
        if (Auth::user()->hasLikedStatus($status)){
            return redirect()->back();
        }

        $like = $status->likes()->create([
            'user_id' => auth()->id()
        ]);
        Auth::user()->likes()->save($like);

        return redirect()->back();
    }
}
