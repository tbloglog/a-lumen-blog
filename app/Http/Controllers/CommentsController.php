<?php

namespace App\Http\Controllers;

use App\Interfaces\ICommentsRepository;
use Illuminate\Http\Request;


class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $commentsRepository;
    private $messages;

    public function __construct(ICommentsRepository $CommentsRepository)
    {
        $this->commentsRepository = $CommentsRepository;
        $this->messages = ['required' => 'Il :attribute è obbligatorio'];
    }

    public function Create(Request $request, int $postId){

        $rules = [
            'content' => 'required'
        ];

        $this->validate($request, $rules, $this->messages);

        $this->commentsRepository->Create(
            $request->content, 
            $postId,
            $request->user()->id
        );

        return response()->json(["success"=>1]);
    }
    


}
