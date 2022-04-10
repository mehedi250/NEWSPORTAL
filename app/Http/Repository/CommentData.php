<?php

namespace App\Http\Repository;
use App\Models\Comment;

class CommentData
{
    public function store($postData)
    {
        Comment::create($postData);
    }
}