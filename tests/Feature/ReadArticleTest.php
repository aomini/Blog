<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadArticleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() : void{

    	parent::setUp();

    	$this->withoutExceptionHandling();

    }
	
	/** @test */
    public function a_user_can_view_articles(){

    	factory('App\Article')->create();
    	
    	$response = $this->get('api/articles');

    	$this->assertCount(1, $response->json());

    }

}

