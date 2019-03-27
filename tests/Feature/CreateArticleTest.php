<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateArticleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() : void{

    	parent::setUp();

    	$this->withoutExceptionHandling();

    }
	
	/** @test */
    public function authenticated_user_can_create_single_article(){

        $user = $this->signIn();
    	
    	$article = factory('App\Article')->create();

    	$this->post('api/article', $article->toArray()); 

    	$this->assertDatabaseHas('articles', ['id' => $article->id, 'user_id' => $user->id]);   	

    }

    /** @test*/
    public function authenticated_user_can_create_multiple_articles(){

        $user = $this->signIn();

    	$title = ['this is title', 'this is second title'];

    	$body = ['this is supposed to be body', 'this is a body as well'];

    	$article['title'] = $title;
    	$article['body'] = $body;

    	$this->post('api/article', $article);

    	$this->assertDatabaseHas('articles', ['title' => $article['title'][0], 'user_id' => 1]);
    	$this->assertDatabaseHas('articles', ['title' => $article['title'][1]]);

    }

}

