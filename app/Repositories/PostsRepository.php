<?php

namespace App\Repositories;

use App\Interfaces\IPostsRepository;
use App\Models\Post;
use App\Models\Comment;
use App\DTOs\PostDto;
use App\DTOs\PostListingDto;
use App\DTOs\CommentDto;
use App\DTOs\UserDto;

class PostsRepository implements IPostsRepository{


    public function Create(string $title, string $content, int $user_id) : int{

        $post = new Post;

        $post->title = $title;
        $post->content = $content;
        $post->user_id = $user_id;

        $post->save();

        return $post->id;

    }

    public function Update(int $post_id, string $title, string $content, int $user_id) : bool{

        $post = Post::where('id',$post_id)->where('user_id',$user_id)->first();

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

        $post = Post::where('id',$post_id)->where('user_id',$user_id)->first();

        if($post != null){

            //elimino tutti i commenti associati
            Comment::where('post_id', $post->id)->delete();

            $post->delete();

            return true;
        }

        return false;
    }

    function GetAll() : array{

        $posts = Post::with(['comments','user'])->get();

        $final = array();
        
        foreach($posts as $post){

            array_push($final, new PostListingDto($post->first()));

        }

        return $final;

    }

    
    public function Get(int $id) : object{

        $post = Post::with(['comments','user'])->where('id', $id)->first();

        $postDTO = new PostDto($post);
          
        return $postDTO;


    }

    private function IsNullOrEmptyString($str){
        return (!isset($str) || trim($str) === '');
    }

}