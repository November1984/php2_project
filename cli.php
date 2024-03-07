<?php

use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Blog\Comment;
use GeekBrains\LevelTwo\Blog\Post;

require_once "vendor/autoload.php";

$fake =  Faker\Factory::create("ru_RU");
$user = new User($fake->firstName(), $fake->lastName("female"));
$post = new Post(1, $user->getId(), $fake->text(10), $fake->text(50));
$comment = new Comment(1, $user->getId(), $post->getId(), $fake->text(30));

echo match ($argv[1]){
    "user" => $user,
    "post" => $post,
    "comment" => $comment
} . PHP_EOL;
