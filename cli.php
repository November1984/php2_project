<?php

use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Blog\Comment;
use GeekBrains\LevelTwo\Blog\Post;

require_once "vendor/autoload.php";


$fake =  Faker\Factory::create("ru_RU");
$user = new User(1, $fake->firstName(), $fake->lastName("female"));
$post = new Post(1, $user->getId(), $fake->realText(rand(10,20)), $fake->realText(rand(50,100)));
$comment = new Comment(1, $user->getId(), $post->getId(), $fake->realText(rand(30,40)));

echo match ($argv[1]){
    "user" => $user,
    "post" => $post,
    "comment" => $comment
} . PHP_EOL;


