<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'sobrenome',
        'email',
        'password',
        'dataNascimento',
        'faculdade',
        'curso',
        'sobre',
        'relacionamento',
        'localizacao',
        'nasceuEm',
        'trabalho',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getName()
    {
        if ($this->nome && $this->sobrenome){
            return "{$this->nome} {$this->sobrenome}";
        }
        return null;
    }

    public function getSobre()
    {
        if($this->sobre)
        {
            return "{$this->sobre}";
        }
        return null;
    }


    public function getAvatarUrl()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://s.gravatar.com/avatar/$hash?s=100&d=mm";
    }
    public function getAvatarUrlBasic()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://s.gravatar.com/avatar/$hash?s=61&d=mm";
    }

    public function status(){
        return $this->hasMany('App\Models\Status', 'user_id')->orderBy('created_at', 'desc');
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()
            ->wherePivot('aceito', true)
            ->get()->merge($this->friendOf()->wherePivot('aceito', true)->get());
    }

    /**
     * FRIEND REQUESTS handling
     */
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('aceito', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('aceito', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        return $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        return $this->friendRequests()->where('id', $user->id)->first()
            ->pivot->update(['aceito' => true]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }
    /*
     * LIKES
     */
    public function likes(){
        return $this->hasMany('App\Models\Like', 'user_id');

    }

    public function hasLikedStatus(Status $status)
    {
        return(bool) $status->likes()
            ->where('likeable_id', $status->id)
            ->where('likeable_type',get_class($status))
            ->where('user_id', $this->id)
            ->count();
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
