<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'slug' => str_slug($faker->text(50)),
        'body'  => $faker->text(200),
        'user_id' => function(){
            return factory('App\User')->create()->id;
        }
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->text(50),
        'user_id'=>function(){
            return factory('App\User')->create()->id;
        },     
    ];
});
