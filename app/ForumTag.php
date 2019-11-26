<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumTag extends Model
{
    protected $table='forum_tag';
    protected $fillable=[
        'forum_id','tag_id'
    ];

    public function ForumData()
    {
        return $this->hasMany('App\Forum','forum_id');
    }
    public function tag()
    {
        return $this->belongsTo('App\Tag','tag_id');
    }
}
