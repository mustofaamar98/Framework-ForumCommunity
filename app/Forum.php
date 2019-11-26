<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table='forums';
    protected $fillable=[
        'user_id','title','slug','description','image','view'
    ];

    protected $guarded = []; 
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function forumTag()
    {
        return $this->belongsTo('App\ForumTag');
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }
}
