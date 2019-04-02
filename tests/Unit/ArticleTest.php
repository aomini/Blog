<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleTest extends TestCase
{
    use DatabaseMigrations, WithFaker;
	
	/** @test */
    public function it_has_a_slug(){

    	$slug = $this->faker->word;

		$article = factory('App\Article')->create(['slug' => $slug]);

		$this->assertDatabaseHas('articles', ['slug' => str_slug($slug)]); 
    }

}

