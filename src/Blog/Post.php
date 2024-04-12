<?php

namespace GeekBrains\MainLevel\Blog;

use GeekBrains\MainLevel\Blog\Repositories\PostRepositoryInterface;
use GeekBrains\MainLevel\Blog\UUID;

class Post
{
    function __construct(
        private UUID $uuid,
        private UUID $userID,
        private string $title,
        private string $text,
        private string $dateOfCreation
    ){
        $this->uuid = $uuid;
        $this->userID = $userID;
        $this->title = $title;
        $this->text = $text;
        $this->dateOfCreation = (string) date("yyyy-mm-dd h:i");
    }
    public function getId(): UUID
    {
            return $this->uuid;
    }

    public function __toString(){
        return $this->title." >>> ".$this->text;
    }

    public function getUserID(): UUID
    {
            return $this->userID;
    }

    public function getTitle(): string
    {
            return $this->title;
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