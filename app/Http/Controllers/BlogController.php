<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::published()->get();
        return view('blog.index', compact('blogs'));
    }


    public function show(Blog $blog)
    {
        return view('blog.post', compact('blog'));
    }
}
