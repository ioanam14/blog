<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    protected $table = 'comments';

    protected $fillable = ['post_id', 'user_id', 'content'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}