<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function commenter(){

    	return $this->belongsTo(User::class, 'user_id', 'id');

    }

}
