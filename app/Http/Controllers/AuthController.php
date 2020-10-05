<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends Controller
{
    
    private $messages;

    public function __construct()
    {
        $this->messages = ['required' => 'Il :attribute è obbligatorio'];
    }


    public function Login(Request $request){

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $this->validate($request, $rules, $this->messages);

        $user = User::where('email', '=', $request->email)->first();

        if($user != null){
            if (Hash::check($request->password,  $user->password)) {
                return response()->json(['token'=>$user->api_token]);
            }
        }

        throw new UnauthorizedHttpException('','Unauthorized | Username o passwor errati');

    }
}

