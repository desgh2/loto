@extends('layouts.main')
@section('title', 'Blogs')
@section('description', )
@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-9">
            <h1 class="heading">Все страницы</h1>
            @foreach ($pages as $page)
                <div class="blog-post d-block">
                    <h3 class="title d-block">{{ $page->name }}</h3>
                    <p class="text d-block">{!! \Str::words($page->text, 20) !!}</p>
                    <a href="{{ route('page', ['page' => $page->slug]) }}" class="btn btn-primary">Подробнее</a>
                </div>
            @endforeach
        </div>
        <div class="col-xl-3">
            @include('partials.about')

            {!! App\Models\Banner::verticalBanner(null) !!}
        </div>
    </div>
</div>
@endsection

