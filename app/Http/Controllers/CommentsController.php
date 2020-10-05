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

        $newId = $this->commentsRepository->Create(
            $request->content, 
            $postId,
            $request->user()->id
        );

        return response()->json(['success'=>1,'id'=>$newId]);
    }
    
    public function Update(Request $request, int $postId, int $commentId){

        if ($request->user()->can('update-comment', $request->user())) {
            if($this->commentsRepository->Update($commentId, $request->content ?? '', $postId, $request->user()->id)){
                return response()->json(['success'=>1]);
            }

            return response()->json(['error'=>1,'message'=>'non puoi modificare questo commento']);
        }

        return response()->json(['error'=>1,'message'=>'non hai i permessi di modificare i commenti'],403);

    }

    public function Delete(Request $request, int $postId, int $commentId){

        if ($request->user()->can('delete-comment', $request->user())) {
            if($this->commentsRepository->Delete($commentId, $request->user()->id)){
                return response()->json(['success'=>1]);
            }

            return response()->json(['error'=>1,'message'=>'non puoi eliminare questo commento']);
        }

        return response()->json(['error'=>1,'message'=>'non hai i permessi di eliminare i commenti'],403);

    }

}
