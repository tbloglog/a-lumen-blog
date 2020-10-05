<?php

namespace App\Dtos;
use App\Models\User;

class UserDto{

    public function __construct(User $user)
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->picture = $user->picture;
    }

    public $id;

    public $name;

    public $email;

    public $picture;


}