<?php

namespace GeekBrains\MainLevel\Blog\Repositories;

use GeekBrains\MainLevel\Blog\UUID;
use GeekBrains\MainLevel\Blog\Comment;
use GeekBrains\MainLevel\Blog\Exceptions\CommentException;
use PDO;
use PDOStatement;

class CommentsRepository implements CommentRepositoryInterface
{
    public function __construct(protected PDO $pdo)
    {}
    public function get(UUID $uuid): Comment
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM comments WHERE uuid = :uuid"
        );
        $statement->execute([
            ":uuid" => (string) $uuid
        ]);
        return $this->makeComment($statement);
    }
    public function save(Comment $comment)
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO comments (uuid, author_uuid, post_uuid, text, created_at)
            VALUES (:uuid, :author_uuid, :post_uuid, :text, :created_at)"
        );
        $statement->execute([
            ":uuid"         => (string)$comment->getId(),
            ":author_uuid"  => (string)$comment->getUserId(),
            ":post_uuid"    => (string)$comment->getPostId(),
            ":text"         => strip_tags(htmlspecialchars_decode($comment->getText())),
            ":created_at"   => $comment->getDateOfCreation(),
        ]);
    }
    protected function makeComment(PDOStatement $statement): Comment
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result === false)
        {
            throw new CommentException (
                "The commentary no found."
            );
        }

        return new Comment(
            new UUID ($result["uuid"]),
            new UUID ($result["author_uuid"]),
            new UUID ($result["post_uuid"]),
            $result["text"],
            $result["created_at"],
        );
    }
}