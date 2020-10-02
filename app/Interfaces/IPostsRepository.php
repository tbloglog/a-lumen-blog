<?php

namespace App\Interfaces;

interface IPostsRepository{

    public function GetAll() : array;

    public function Get(int $id) : object;

    public function Create(string $title, string $content, int $user_id) : void;

    public function Update(int $post_id, string $title, string $content, int $user_id) : bool;

}