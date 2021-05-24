<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;
use \App\Classes\Api;

class ResultController extends Controller
{
    protected $api_id = '1966';
    protected $api_key = 'f8171bb80d78fe536e027cbc8273ddbe';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Result::paginate(config('result'));
        return view('dashboard.result.index', compact('results'));
    }

    public function add()
    {
        //api
        $api = new Api($this->api_id, $this->api_key);
        $api->setLang('en');
        //лотореи
        $list_results = json_decode($api->ListResults()); //получаем результаты лотереи
        $results = collect($list_results->data); //коллекция результатов
        #dd($results);
        foreach ($results as $loto) {
            $hasResult = Result::where('lottery_id', $loto->id)->where('close_date', $loto->close_date)->first(); //получаем результат по id и дате розыграша
            if(!$hasResult) { //если результата нет, добавляем в БД
                $data = new Result;
                $data->lottery_id   = $loto->id;
                $data->name         = $loto->title;
                $data->image        = $loto->image;
                $data->currency     = $loto->currency;
                $data->jackpot      = $loto->jackpot;
                $data->close_date   = $loto->close_date;
                $data->draw_result  = json_encode($loto->draw_result);
                $data->save();
            }
        }
        //notification flash
        $notification = [
            'message' => 'Результаты добавлены',
            'class'   => 'success'
        ];   
        session()->flash('notification', $notification);
        return redirect('dashboard/result');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
}
