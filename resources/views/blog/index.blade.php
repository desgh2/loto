@extends('layouts.main')
@section('title', 'Blogs')
@section('description', )
@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-9">
            <h1 class="heading">Все записи в блоге</h1>
            @foreach ($blogs as $blog)
                <div class="blog-post">
                    <div class="blog-post-img"><img src="{{ $blog->image ? asset($blog->image) : asset('noimage.png') }}" alt=""></div>
                    <div class="blog-post-body">
                        <h3 class="title">{{ $blog->name }}</h3>
                        <p class="text">{!! \Str::words($blog->text, 20) !!}</p>
                        <a href="{{ route('blog', ['blog' => $blog->slug]) }}" class="btn btn-primary">Подробнее</a>
                    </div>
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

