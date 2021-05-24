<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::published();
        return view('pages.index', compact('pages'));
    }

    public function show(Page $page)
    {
        return view('pages.post', compact('page'));
    }

}
