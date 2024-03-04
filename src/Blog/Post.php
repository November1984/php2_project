<?php

namespace GeekBrains\LevelTwo\Blog;

class Post {
    function __construct(
        private int $id,
        private int $userID,
        private string $header,
        private string $text
    ){

    }
}