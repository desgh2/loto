<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('dashboard.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.page.create');
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
            'name' => 'required|max:400',
            'title' => 'required|max:400',
            'description' => 'required|max:400',
            'heading' => 'required|max:400',
            'text' => 'required',
        ],[
            'name.required' => 'Поле Название обязательно',
            'title.required' => 'Поле Заголовок (title) обязательно',
            'description.required' => 'Поле Описание (description) обязательно',
            'heading.required' => 'Поле Заголовок (H1) обязательно',
            'text.required' => 'Поле Контент обязательно',
        ]);

        Page::create([
            'name'          => $request->name,
            'title'         => $request->title,
            'description'   => $request->description,
            'slug'          => Str::slug($request->name, '-'),
            'heading'       => $request->heading,
            'text'          => $request->text,
            'author'        => auth()->user()->id,
        ]);

        //notification flash
        $notification = [
            'message' => 'Страница добавлена',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('page.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('dashboard.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'name' => 'required|max:400',
            'title' => 'required|max:400',
            'description' => 'required|max:400',
            'heading' => 'required|max:400',
            'text' => 'required',
        ],[
            'name.required' => 'Поле Название обязательно',
            'title.required' => 'Поле Заголовок (title) обязательно',
            'description.required' => 'Поле Описание (description) обязательно',
            'heading.required' => 'Поле Заголовок (H1) обязательно',
            'text.required' => 'Поле Контент обязательно',
        ]);

        $page->update([
            'name'          => $request->name,
            'title'         => $request->title,
            'description'   => $request->description,
            'slug'          => $request->slug,
            'heading'       => $request->heading,
            'text'          => $request->text,
            'author'        => auth()->user()->id,
        ]);

        //notification flash
        $notification = [
            'message' => 'Страница изменена',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        //notification flash
        $notification = [
            'message' => 'Страница удалена',
            'class'   => 'info'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('page.index');
    }

    public function status(Page $page)
    {
        $page->update([
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
