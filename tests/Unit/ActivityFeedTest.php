<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActivityFeedTest extends TestCase
{
    use DatabaseMigrations;
	
	/** @test */
    public function it_records_activity_when_an_article_is_created(){

    	$user = $this->signIn();
    	
    	$article = factory('App\Article')->create(['user_id' => $user->id]); 	

    	$this->assertDatabaseHas('activities', [

    		'user_id'	=> $article->user_id,
    		'type'		=> "created_article",
    		'subject'	=>	get_class($article),
    		'subject_id'=>	$article->id

    	]);


    }

}

