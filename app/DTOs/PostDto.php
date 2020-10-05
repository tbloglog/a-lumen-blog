<?php

namespace App\Dtos;
use App\Models\Post;
use App\Dtos\UserDto;
use App\Dtos\CommentDto;

class PostDto{

    public function __construct(Post $post)
    {
        $this->id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->author = new UserDto($post->user);
        $this->comments_count = $post->comments->count();
        
        $allComments = $post->comments;

        $this->comments = [];
        foreach($allComments as $comment){

            array_push($this->comments, new CommentDto($comment));
            
        }

    }

    public $id;
    
    public $title;
    
    public $content;
    
    public $author;

    public $comments_count;

    public $comments;

}