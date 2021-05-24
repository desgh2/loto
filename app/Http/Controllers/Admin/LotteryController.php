<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lottery;
use Illuminate\Http\Request;
use \App\Classes\Api;

class LotteryController extends Controller
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
        $lottery = Lottery::paginate(config('lottery'));
        return view('dashboard.lottery.index', compact('lottery'));
    }

    /**
     * Add lotteries
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        //api
        $api = new Api($this->api_id, $this->api_key);
        $api->setLang('en');
        //лотореи
        $list_lotteries = json_decode($api->ListLotteries()); //получаем лотереи
        $lottery = collect($list_lotteries->data); //коллекция лотерей
        foreach ($lottery as $loto) {
            $hasLottery = Lottery::whereLotoId($loto->id)->first(); //получаем лотерею по id
            if(!$hasLottery) { //если лотереи нет, добавляем в БД
                $data = new Lottery;
                $data->loto_id      = $loto->id;
                $data->name         = $loto->title;
                $data->slug         = \Str::slug($loto->title, '-');
                $data->image        = $loto->image;
                $data->currency     = $loto->currency;
                $data->jackpot      = $loto->jackpot;
                $data->rating       = $loto->rating;
                $data->close_date   = $loto->close_date;
                $data->countdown    = $loto->countdown + time();
                $data->save();
            }
        }
        //notification flash
        $notification = [
            'message' => 'Лотереи добавлены',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect('dashboard/lottery');
    }
    /**
     * Обновление лотереи
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh(Lottery $lottery)
    {
        $api = new Api($this->api_id, $this->api_key);
        $api->setLang('en');
        $loto = json_decode($api->GetLottery(['id' => $lottery->loto_id]));
        #dd($loto);
        $lottery->update([
            'country' => $loto->data[0]->country,
           // 'image' => $loto->data[0]->image,
            'currency' => $loto->data[0]->currency,
            'jackpot' => $loto->data[0]->jackpot,
            'rating' => $loto->data[0]->rating,
            'bonusball' => $loto->data[0]->bonusball,
            'reintegro' => $loto->data[0]->reintegro,
            'extra' => $loto->data[0]->extra,
            'regular_min' => $loto->data[0]->regular_min,
            'regular_max' => $loto->data[0]->regular_max,
            'regular_per_line' => $loto->data[0]->regular_per_line,
            'special_min' => $loto->data[0]->special_min,
            'special_max' => $loto->data[0]->special_max,
            'special_per_line' => $loto->data[0]->special_per_line,
            'close_date' => $loto->data[0]->close_date,
            'countdown' => $loto->data[0]->countdown + time(),
        ]);
        //notification flash
        $notification = [
            'message' => 'Информация о лотереи обновлена',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect('dashboard/lottery');
    }

    public function refresh_all()
    {
        $api = new Api($this->api_id, $this->api_key);
        $api->setLang('en');
        foreach (Lottery::all() as $lottery) {
            sleep(1);
            $loto = json_decode($api->GetLottery(['id' => $lottery->loto_id]));
            $lottery->update([
                #'name' => $loto->data[0]->title,
                'country' => $loto->data[0]->country,
                //'image' => $loto->data[0]->image,
                'currency' => $loto->data[0]->currency,
                'jackpot' => $loto->data[0]->jackpot,
                'rating' => $loto->data[0]->rating,
                'bonusball' => $loto->data[0]->bonusball,
                'reintegro' => $loto->data[0]->reintegro,
                'extra' => $loto->data[0]->extra,
                'regular_min' => $loto->data[0]->regular_min,
                'regular_max' => $loto->data[0]->regular_max,
                'regular_per_line' => $loto->data[0]->regular_per_line,
                'special_min' => $loto->data[0]->special_min,
                'special_max' => $loto->data[0]->special_max,
                'special_per_line' => $loto->data[0]->special_per_line,
                'close_date' => $loto->data[0]->close_date,
                'countdown' => $loto->data[0]->countdown + time(),
            ]);
        }
        //notification flash
        $notification = [
            'message' => 'Все лотереи обновлены',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect('dashboard/lottery');
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
     * @param  \App\Models\Lottery  $lottery
     * @return \Illuminate\Http\Response
     */
    public function show(Lottery $lottery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lottery  $lottery
     * @return \Illuminate\Http\Response
     */
    public function edit(Lottery $lottery)
    {
        $previous = url()->previous();
        return view('dashboard.lottery.edit', compact('lottery', 'previous'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lottery  $lottery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lottery $lottery)
    {
        request()->validate([
            'title'         => ['required', 'max:350'],
            'description'   => ['required', 'max:350'],
            'heading'       => ['required', 'max:350'],
            'name'          => ['required', 'max:350'],
            'slug'          => ['required', 'max:350'],
            'text'          => ['required'],
            'country'       => ['required', 'max:20'],
            'rating'        => ['required', 'max:20'],
            'currency'      => ['required', 'max:20'],
        ]);
        //logotype
        if(request()->hasFile('image')) {
            $path = 'uploads/';
            $image = request()->file('image');
            $file = strtolower($path.$image->getClientOriginalName());
            $image->move(public_path($path), $file);
        } else {
            $file = $lottery->image;
        }

        $lottery->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'heading'       => $request->heading,
            'name'          => $request->name,
            'slug'          => \Str::slug($request->slug, '-'),
            'text'          => $request->text,
            'ticket'        => $request->ticket,
            'country'       => $request->country,
            'image'         => $file,
            'currency'      => $request->currency,
            'rating'        => $request->rating,
        ]);

        //notification flash
        $notification = [
            'message' => 'Информация о лотереи отредактирована',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect($request->previous);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lottery  $lottery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lottery $lottery)
    {
        $lottery->delete();
        //notification flash
        $notification = [
            'message' => 'Лотерея удалена',
            'class'   => 'info'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('lottery.index');
    }

    public function status(Lottery $lottery)
    {
        $lottery->update([
            'published' => request()->has('status')
        ]);
        //notification flash
        $notification = [
            'message' => 'Статус обновлен',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return back();
    }

}
