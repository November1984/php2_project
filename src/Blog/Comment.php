<?php

namespace GeekBrains\MainLevel\Blog;

use GeekBrains\MainLevel\Blog\UUID;

class Comment
{
    function __construct(
        private UUID $uuid,
        private UUID $userId,
        private UUID $postId, 
        private string $text,
        private string $dateOfCreation
    ){
        $this->uuid = $uuid;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->text = $text;
        $this->dateOfCreation = $dateOfCreation;
    }

    function __toString(){
        return $this->text;
    }


        public function getId(): UUID
        {
                return $this->uuid;
        }

        public function getUserId(): UUID
        {
                return $this->userId;
        }

        public function getPostId(): UUID
        {
                return $this->postId;
        }

        public function getText(): string
        {
                return $this->text;
        }

        public function getDateOfCreation(): string
        {
                return $this->dateOfCreation;
        }
}