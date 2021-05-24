<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::paginate(10);
        return view('dashboard.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.blog.create');
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

        //image
        if(request()->hasFile('image')) {
            $path = 'uploads/';
            $image = request()->file('image');
            $file = strtolower($path.$image->getClientOriginalName());
            $image->move(public_path($path), $file);
        } else {
            $file = null;
        }

        Blog::create([
            'name'          => $request->name,
            'title'         => $request->title,
            'description'   => $request->description,
            'slug'          => Str::slug($request->name, '-'),
            'heading'       => $request->heading,
            'text'          => $request->text,
            'image'         => $file,
            'author'        => auth()->user()->id,
        ]);

        //notification flash
        $notification = [
            'message' => 'Запись добавлена',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('dashboard.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
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

        //image
        if(request()->hasFile('image')) {
            $path = 'uploads/';
            $image = request()->file('image');
            $file = strtolower($path.$image->getClientOriginalName());
            $image->move(public_path($path), $file);
        } else {
            $file = $blog->image;
        }

        $blog->update([
            'name'          => $request->name,
            'title'         => $request->title,
            'description'   => $request->description,
            'slug'          => $request->slug,
            'heading'       => $request->heading,
            'text'          => $request->text,
            'image'         => $file,
            'author'        => auth()->user()->id,
        ]);

        //notification flash
        $notification = [
            'message' => 'Запись изменена',
            'class'   => 'success'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        //notification flash
        $notification = [
            'message' => 'Запись удалена',
            'class'   => 'info'
        ];
        session()->flash('notification', $notification);
        return redirect()->route('blog.index');
    }


    public function status(Blog $blog)
    {
        $blog->update([
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
