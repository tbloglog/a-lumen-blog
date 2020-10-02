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

    public function Update(int $comment_id, string $content, int $post_id,int $user_id) : bool{

        $comment = Comment::where("id",$comment_id)
                        ->where("user_id",$user_id)
                        ->where("post_id",$post_id)
                        ->first();
        
        if($comment != null){
            if(trim($content) != ''){

                $comment->content = $content;
                $comment->save();
            
            }

            return true;
        }

        return false;

    }
    
    public function Delete(int $comment_id, int $user_id) : bool{

        $comment = Comment::where("id",$comment_id)->where("user_id",$user_id)->first();

        if($comment != null){
            $comment->delete();
            return true;
        }

        return false;

    }


}