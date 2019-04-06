<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavouritesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() : void{

    	parent::setUp();

    	$this->withoutExceptionHandling();

    }

    private function createComment($article){

        return $comment = factory('App\Comment')->create([
            'commentable_id'    => $article->id,
            'commentable_type'  => get_class($article),
            'user_id'           => auth()->id() 
        ]);

    }
	
	/** @test */
    public function an_authenticated_user_can_favourite_comments(){
    	
    	$user = $this->signIn();    	

    	$article = factory('App\Article')->create();

    	$comment = $this->createComment($article);

    	$this->post("comment/{$comment->id}/favourite");

    	$this->assertCount(1, $comment->favourites);
    	$this->assertEquals(1, $comment->favourites_count);
    }

    /** @test*/
    public function an_authenticated_user_can_favourite_comments_only_once(){
        
        $user = $this->signIn();        

        $article = factory('App\Article')->create();

        $comment = $this->createComment($article);

        $this->post("comment/{$comment->id}/favourite");
        $this->post("comment/{$comment->id}/favourite");
        
        $this->assertCount(1, $comment->favourites);
        $this->assertEquals(1, $comment->favourites_count);

    }

    /** @test*/
    public function a_user_can_favourite_article(){
        
        $user = $this->signIn();

        $article = factory('App\Article')->create(['user_id' => $user->id]);

        $this->post("article/{$article->slug}/favourite");

        $this->assertCount(1, $article->favourites);

    }

    /** @test*/
    public function a_user_already_favourited(){
        
        $user = $this->signIn();

        $article = factory('App\Article')->create(['user_id' => $user->id]);

        $comment = $this->createComment($article);

        $this->post("article/{$article->slug}/favourite");
        $this->post("comment/{$comment->id}/favourite");

        $this->assertTrue($article->isFavourited());
        $this->assertTrue($comment->isFavourited());

    }

}

