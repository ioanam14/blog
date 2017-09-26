<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = 'posts';

    protected $fillable = ['user_id', 'title', 'content', 'thumbnail', 'slug'];

    public function comments()
    {
        return $this->hasMany('App\CommentModel','post_id')->orderBy('created_at', 'desc');
    }
}