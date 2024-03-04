<?php

namespace GeekBrains\LevelTwo\Blog;

class Comment{
    function __construct(
        private int $id,
        private int $userId,
        private int $postId, 
        private string $text
    ){

    }
}