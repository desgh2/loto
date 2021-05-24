<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
    	$setting = Setting::first();
    	return view('dashboard.setting', compact('setting'));
    }

    public function store(Request $request)
    {
    	request()->validate([
    		'title' 		=> ['required', 'max:300'],
    		'description' 	=> ['required', 'max:300'],
    		'heading' 		=> ['required', 'max:300'],
    		'text' 			=> ['required'],
    	]);

        Setting::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'heading'          => $request->heading,
            'text'             => $request->text,
            'lottery_count'    => $request->lottery_count,
            'result_count'     => $request->result_count,
            'recommend'        => json_encode($request->recommend),
            'address'          => $request->address,
            'email'            => $request->email,
            'phone'            => $request->phone,
        ]);

    	//notification flash
        $notification = [
            'message' => 'Настройки сайта добавлены',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect('dashboard/setting');
    }

    public function update(Request $request, Setting $setting)
    {
    	request()->validate([
    		'title' 		=> ['required', 'max:300'],
    		'description' 	=> ['required', 'max:300'],
    		'heading' 		=> ['required', 'max:300'],
    		'text' 			=> ['required'],
    	]);
    	$setting->update([
    		'title' 		=> $request->title,
    		'description' 	=> $request->description,
    		'heading' 		=> $request->heading,
    		'text' 			=> $request->text,
    		'lottery_count' => $request->lottery_count,
    		'result_count' 	=> $request->result_count,
    		'recommend' 	=> json_encode($request->recommend),
            'address'       => $request->address,
            'email'         => $request->email,
            'phone'         => $request->phone,
    	]);
    	//notification flash
        $notification = [
            'message' => 'Настройки сайта добавлены',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect('dashboard/setting');
    }


}
