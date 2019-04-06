<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    
	public function favouriteComment(Comment $comment){

		$comment->favouritable();

		return back();

	}

	public function favouriteArticle(Article $article){

		$article->favouritable();

		return back();

	}


}
