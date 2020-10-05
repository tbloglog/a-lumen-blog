<?php

namespace App\Http\Controllers;

use App\Interfaces\IPostsRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $postsRepository;
    private $messages;

    public function __construct(IPostsRepository $PostsRepository)
    {
        $this->postsRepository = $PostsRepository;
        $this->messages = ['required' => 'Il :attribute è obbligatorio'];
    }

    public function Create(Request $request){

        $rules = [
            'title' => 'required',
            'content' => 'required'
        ];

        $this->validate($request, $rules, $this->messages);

        $newId = $this->postsRepository->Create(
            $request->title, 
            $request->content,
            $request->user()->id
        );

        return response()->json($this->postsRepository->Get($newId));
    }
    
    public function Update(Request $request, int $postId){

        if($this->postsRepository->Update($postId,$request->title ?? '',$request->content ?? '',$request->user()->id)){
            return response()->json($this->postsRepository->Get($postId));
        }

        throw new NotFoundHttpException();
    }

    public function Delete(Request $request, int $postId){

        if($this->postsRepository->Delete($postId,$request->user()->id)){
            return response()->json([]);
        }

        throw new NotFoundHttpException();
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
