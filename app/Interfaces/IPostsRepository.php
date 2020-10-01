<?php

namespace App\Interfaces;

interface IPostsRepository{

    public function GetAll() : array;

    public function Get(int $id) : object;

}