<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with(['user', 'book'])
            ->orderBy(Post::CREATED_AT, 'desc')->paginate(6);
        return $posts;
    }

}
