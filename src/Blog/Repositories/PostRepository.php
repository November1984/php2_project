<?php
namespace GeekBrains\MainLevel\Blog\Repositories;

use GeekBrains\MainLevel\Blog\Exceptions\PostException;
use GeekBrains\MainLevel\Blog\UUID;
use GeekBrains\MainLevel\Blog\Post;
use \PDO;
use PDOStatement;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(protected PDO $pdo)
    {}
    public function get(UUID $uuid): Post
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM posts WHERE uuid = :uuid"
        );
        $statement->execute([
            ":uuid" => (string)$uuid,
        ]);
        return $this->makePost($statement);
    }
    public function save(Post $post)
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO posts (uuid, author_uuid, title, text, created_at)
            VALUES (:uuid, :author_uuid, :title, :text, :created_at)"); 
        
        $statement->execute([
        ":uuid"         => (string) $post->getID(),
        ":author_uuid"  => (string) $post->getUserID(),
        ":title"        => strip_tags(htmlspecialchars_decode($post->getTitle())),
        ":text"         => strip_tags(htmlspecialchars_decode($post->getText())),
        ":created_at"   => $post->getDateOfCreation(),
        ]);
    }
    protected function makePost(PDOStatement $statement): Post
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result === false)
        {
            throw new PostException(
                "The post not found."
            );
        }
        return new Post (
            new UUID ($result["uuid"]),
            new UUID ($result["author_uuid"]),
            $result["title"],
            $result["text"],
            $result["created_at"]
        );
    }
}