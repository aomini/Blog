<?php

namespace App\Traits\Comment;

use App\Comment;
use App\Favourite;

trait Favouritable{

	public function favourites(){
		return $this->morphMany(Favourite::class, 'favourable');
	}

	public function getFavouritesCountAttribute(){
		return $this->favourites->count();
	}

	public function favouritable(){

		$attributes = [
			'user_id' => auth()->id()
		];

		if(!$this->favourites()->where($attributes)->exists()){			
			$this->favourites()->create($attributes);
		}
	}

	public function isFavourited(){
		return !! $this->favourites()->where('user_id', auth()->id())->count();
	}
}