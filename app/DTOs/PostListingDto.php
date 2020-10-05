<?php

namespace App\Dtos;
use App\Models\Post;
use App\Dtos\UserDto;

class PostListingDto{

    public function __construct(Post $post)
    {
        $this->id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->author = new UserDto($post->user);
        $this->comments_count = $post->comments->count();
        
    }

    public $id;
    
    public $title;
    
    public $content;
    
    public $author;

    public $comments_count;

}