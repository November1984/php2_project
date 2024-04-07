<?php

namespace GeekBrains\MainLevel\Blog;

class Comment{
    function __construct(
        private int $id,
        private UUID $userId,
        private int $postId, 
        private string $text
    ){
        $this->id = $id;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->text = $text;
    }

    function __toString(){
        return $this->text;
    }
}