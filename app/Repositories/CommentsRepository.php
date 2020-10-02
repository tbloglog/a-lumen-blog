<?php

namespace App\Repositories;

use App\Interfaces\ICommentsRepository;
use App\Models\Comment;

class CommentsRepository implements ICommentsRepository{

    public function Create(string $content, int $post_id, int $user_id) : void{

        $comment = new Comment;

        $comment->content = $content;
        $comment->post_id = $post_id;
        $comment->user_id = $user_id;

        $comment->save();

    }


}