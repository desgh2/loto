<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Lottery;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::all();
        return view('dashboard.banner.index', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lottery = Lottery::all();
        $previous = url()->previous();
        return view('dashboard.banner.create', compact('lottery', 'previous'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'loto_id' => 'required',
            'name' => 'required',
            'size' => 'required',
            'script' => 'required',
            'type' => 'required',
        ]);

        Banner::create($request->all());

        //notification flash
        $notification = [
            'message' => 'Баннер добавлен',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('banner.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $lottery = Lottery::all();
        $previous = url()->previous();
        return view('dashboard.banner.edit', compact('lottery', 'banner', 'previous'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'loto_id' => 'required',
            'name' => 'required',
            'size' => 'required',
            'script' => 'required',
            'type' => 'required',
        ]);

        $banner->update($request->all());

        //notification flash
        $notification = [
            'message' => 'Баннер обновлен',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        //notification flash
        $notification = [
            'message' => 'Баннер удален',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('banner.index');
    }
}
