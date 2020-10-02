<?php

namespace App\Repositories;

use App\Interfaces\IPostsRepository;
use App\Models\Post;
use App\Models\Comment;
use App\DTOs\PostDto;
use App\DTOs\PostListingDto;
use App\DTOs\CommentDto;

class PostsRepository implements IPostsRepository{

    public function Create(string $title, string $content, int $user_id) : void{

        $post = new Post;

        $post->title = $title;
        $post->content = $content;
        $post->user_id = $user_id;

        $post->save();

    }

    public function Update(int $post_id, string $title, string $content, int $user_id) : bool{

        $post = Post::where("id",$post_id)->where("user_id",$user_id)->first();

        if($post != null){

            if(!$this->IsNullOrEmptyString($title)){
                $post->title = $title;
            }
            if(!$this->IsNullOrEmptyString($content)){
                $post->content = $content;
            }

            $post->save();

            return true;

        }

        return false;

    }

    public function Delete(int $post_id, int $user_id) : bool{

        $post = Post::where("id",$post_id)->where("user_id",$user_id)->first();

        if($post != null){

            //elimino tutti i commenti associati
            Comment::where('post_id', $post->id)->delete();

            $post->delete();

            return true;
        }

        return false;
    }

    function GetAll() : array{

        $posts = Post::all();
    
        $final = array();
        
        foreach($posts as $post){

            $tmpDTO = new PostListingDto();
            
            $tmpDTO->id = $post->id;
            $tmpDTO->title = $post->title;
            $tmpDTO->content = $post->content;
            $tmpDTO->author = $post->user->name;
            $tmpDTO->comments_count = $post->comments->count();
            
            array_push($final, $tmpDTO);

        }

        return $final;

    }

    public function Get(int $id) : object{

        $post = Post::where('id', $id)->first();

        $postDTO = new PostDto();
            
        $postDTO->id = $post->id;
        $postDTO->title = $post->title;
        $postDTO->content = $post->content;
        $postDTO->author = $post->user->name;
        $postDTO->comments_count = $post->comments->count();
        
        $allComments = $post->comments;

        $postDTO->comments = [];
        foreach($allComments as $comment){
            $tmpCommentDTO = new CommentDto();

            $tmpCommentDTO->id = $comment->id;
            $tmpCommentDTO->comment = $comment->content;
            $tmpCommentDTO->author = $comment->user->name;

            array_push($postDTO->comments,$tmpCommentDTO);

        }
        
        return $postDTO;


    }

    private function IsNullOrEmptyString($str){
        return (!isset($str) || trim($str) === '');
    }

}