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
    	
    	$article = factory('App\Article')->make();

    	$this->post('article', $article->toArray()); 

    	$this->assertDatabaseHas('articles', ['title' => $article->title, 'user_id' => $user->id]);   	

    }

    /** @test*/
    public function authenticated_user_can_create_multiple_articles(){

        $user = $this->signIn();

    	$title = ['this is title', 'this is second title'];

    	$body = ['this is supposed to be body', 'this is a body as well'];

    	$article['title'] = $title;
    	$article['body'] = $body;

    	$this->post('article', $article);

    	$this->assertDatabaseHas('articles', ['title' => $article['title'][0], 'user_id' => 1]);
    	$this->assertDatabaseHas('articles', ['title' => $article['title'][1]]);

    }

    /** @test*/
    public function a_user_can_only_delete_his_article(){
        
        $user = $this->signIn();

        $this->withoutExceptionHandling();

        $own_article = factory('App\Article')->create(['user_id' => $user->id]);
        $others_article = factory('App\Article')->create([
            'user_id' => function(){
                return factory('App\User')->create()->id;
            }
        ]);

        try{
           $this->JSON('DELETE', "/article/{$own_article->slug}");
           $this->assertDatabaseMissing('articles', ["id" => $own_article->id]); 
       }catch(\Exception $e){
            $this->fail($e->getMessage());
       }

       

        

    }
   
    

}

