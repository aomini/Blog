<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadArticleTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function setUp() : void{

    	parent::setUp();

    	$this->withoutExceptionHandling();

    }
	
	/** @test */
    public function a_user_can_view_articles(){

    	$article = factory('App\Article')->create();
    	
    	$response = $this->get('articles');

    	$response->assertSee($article->title);

    }

    /** @test*/
    public function a_user_can_view_an_article(){

        $article = factory('App\Article')->create();
        
        $this->get("article/{$article->slug}")
        ->assertSee($article->body)
        ->assertSee($article->title);
    }

    /** @test*/
    public function a_user_can_see_all_comments_to_a_article(){
        
        $this->signIn();

        $first_comment = $this->faker->sentence;
        $second_cmt = $this->faker->sentence;

        $article = factory('App\Article')->create();
        
        $article->each(function($u) use($first_comment, $second_cmt){
            $u->commentable((object)["comment" => $first_comment]);
            $u->commentable((object)["comment" => $second_cmt]);
        });

        $this->get("/article/{$article->slug}")
        ->assertSee($first_comment)
        ->assertSee($second_cmt);

    }

}

