<?php

namespace App\Interfaces;

interface IPostsRepository{

    public function GetAll() : array;

    public function Get(int $id) : object;

    public function Create(string $title, string $content, int $user_id) : int;

    public function Update(int $post_id, string $title, string $content, int $user_id) : bool;

    public function Delete(int $post_id, int $user_id) : bool;

    public function Exists(int $post_id) : bool;

}