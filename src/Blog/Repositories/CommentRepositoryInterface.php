<?php

namespace GeekBrains\MainLevel\Blog\Repositories;

use GeekBrains\MainLevel\Blog\Comment;
use GeekBrains\MainLevel\Blog\UUID;

interface CommentRepositoryInterface
{
    public function get(UUID $uuid): Comment;
    public function save(Comment $comment);
}