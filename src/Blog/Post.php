<?php

namespace GeekBrains\LevelTwo\Blog;

class Post {
    function __construct(
        private int $id,
        private int $userID,
        private string $title,
        private string $text
    ){
        $this->id = $id;
        $this->userID = $userID;
        $this->title = $title;
        $this->text = $text;
    }

        public function getId(): int
        {
                return $this->id;
        }

        function __toString(){
            return $this->title." >>> ".$this->text;
        }
}