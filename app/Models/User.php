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
//        'sobre',
//        'personalidade',
        'localizacao',
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

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{md5($this->email)}}?d=mm";
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
