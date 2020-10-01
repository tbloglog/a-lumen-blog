<?php

namespace App\Http\Controllers;

use App\Interfaces\IPostsRepository;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $postsRepository;

    public function __construct(IPostsRepository $PostsRepository)
    {
        $this->postsRepository = $PostsRepository;
    }

    
    public function List(){

        $allPosts = $this->postsRepository->GetAll();

        return response()->json($allPosts);
    }

    public function Detail(Request $request, int $postId){

        $postDetail = $this->postsRepository->Get($postId);

        return response()->json($postDetail);

    }

}
