<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Article extends Model
{
    
	protected $guarded = [];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function getRouteKeyName(){
		return 'slug';
	}

	public function setTitleAttribute($value){

		$this->attributes['title'] = $value;

		$this->attributes['slug'] = str_slug($value);
		
	}

	public function comments(){

		return $this->morphMany(Comment::class, 'commentable')->orderByDesc('id');

	}

	public function commentable($request){

		$this->comments()->create([
			'comment' 	=> $request->comment,
			'user_id'	=> auth()->id(),
		]);
		
	}

}
