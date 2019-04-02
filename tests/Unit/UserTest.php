<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;
	
	/** @test */
    public function it_has_many_articles(){
    	
    	$user = $this->signIn();

    	factory('App\Article', 3)->create([ 'user_id' => $user->id ]);

    	$this->assertCount(3, $user->articles);

    }

}


