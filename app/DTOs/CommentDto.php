<?php

namespace App\Dtos;
use App\Models\Comment;
use App\Dtos\UserDto;

class CommentDto{

    public function __construct(Comment $comment)
    {
        $this->id = $comment->id;
        $this->comment = $comment->content;
        $this->author = new UserDto($comment->user);
    }

    public $id;

    public $comment;

    public $author;

}