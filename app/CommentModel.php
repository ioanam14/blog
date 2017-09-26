<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    protected $table = 'comments';

    protected $fillable = ['comment', 'user_id', 'post_id'];

    public function user ()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}