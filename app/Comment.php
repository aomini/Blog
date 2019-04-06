<?php

namespace App;

use App\Traits\Comment\Favouritable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use Favouritable;

    protected $guarded = [];

    public function commenter(){

    	return $this->belongsTo(User::class, 'user_id', 'id');

    }

   

}
