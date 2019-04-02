<?php

namespace App\Http\Controllers;

use App\{Article, Comment};
use Illuminate\Http\Request;

class CommentController extends Controller
{

	public function __construct(){

		$this->middleware('auth')->only(['store']);
		
	}

    public function store(Request $request, Article $article){

    	$article->commentable($request);

    	return back();

    }
}
