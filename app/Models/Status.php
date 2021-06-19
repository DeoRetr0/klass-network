<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = [
        'body',
        'user_id',
        'likeable_id'
    ];

    public function User(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Status', 'parent_id');
    }

    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    public function likeCount($id){ 
        return $this->where('id', $id)->withCount('likes')->first();
    }
}

/* 
    public function likeCount($id){ 
        return $this->where('id', $id)->withCount('likes')->first();
    }
*/

