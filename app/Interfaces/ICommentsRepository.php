<?php

namespace App\Interfaces;

interface ICommentsRepository{

    public function Create(string $content, int $post_id, int $user_id) : int;

    public function Update(int $comment_id, string $content, int $post_id,int $user_id) : bool;

    public function Delete(int $comment_id, int $user_id) : bool;

}