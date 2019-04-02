<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() : void{

    	parent::setUp();

    	$this->withoutExceptionHandling();

    }
	
	/** @test */
    public function a_user_has_his_own_article_on_concern_profile(){
    	
    	$user = factory('App\User')->create();

    	$own_thread = factory('App\Article')->create(['user_id' => $user->id]);

    	$other_threads = factory('App\Article')->create(['user_id' => 999]);

    	$this->get("/profile/{$user->name}")
    	->assertSee($own_thread->title);

    }

}

