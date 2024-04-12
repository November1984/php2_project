<?php

namespace GeekBrains\MainLevel\Blog\Repositories;

use GeekBrains\MainLevel\Blog\Post;
use GeekBrains\MainLevel\Blog\UUID;

interface PostRepositoryInterface
{
    public function get(UUID $uuid): Post;
    public function save(Post $post);
}