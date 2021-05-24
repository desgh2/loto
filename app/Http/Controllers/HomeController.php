<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Classes\Api;
use App\Models\Lottery;
use App\Models\Result;
use App\Models\Blog;


class HomeController extends Controller
{

    protected $api_id = '1966';
    protected $api_key = 'f8171bb80d78fe536e027cbc8273ddbe';

    /*
        Home page
    */
    public function index()
    {
        $lottery = Lottery::published()->get(); //все лотереи
        $results = Result::with('lottery')->take(5)->orderBy('close_date', 'desc')->get(); //последние результаты
        return view('index', compact('lottery', 'results'));
    }






}
