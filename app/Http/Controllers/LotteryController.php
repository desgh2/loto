<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Models\Result;

class LotteryController extends Controller
{
	//Все лотереи
    public function all()
    {
    	$lottery = Lottery::all();
    	return view('lotteries', compact('lottery'));
    }

    //Лотерея
    public function lottery(Lottery $lottery)
    {
    	return view('lottery', compact('lottery'));
    }

    //Последние результаты
    public function results()
    {
    	$lottery = Lottery::with('result')->get();
    	return view('results', compact('lottery'));
    }

    //Результаты конкретной лотереи
    public function result($slug)
    {
    	$lottery = Lottery::with('results')->whereSlug($slug)->firstOrFail();
        return view('result', compact('lottery'));
    }
}
