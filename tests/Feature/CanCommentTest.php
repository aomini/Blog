<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CanCommentTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function setUp() : void{

    	parent::setUp();

    	$this->withoutExceptionHandling();

    }
	
	/** @test */
    public function an_authenticated_user_can_comment_a_post(){
    	
    	$user = $this->signIn();

    	$article = factory('App\Article')->create();

    	$this->post("article/{$article->slug}/comment", [
    		'comment' => $this->faker->sentence,
    	]);
    	$this->assertCount(1, $article->comments);

    }

    /** @test*/
    public function an_unauthenticated_user_cannot_comment_on_a_post(){
    	
    	$this->withExceptionHandling();

    	$article = factory('App\Article')->create();

    	$response = $this->post("article/{$article->slug}/comment");

    	$response->assertRedirect('/login');

    }

}

