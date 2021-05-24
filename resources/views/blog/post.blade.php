@extends('layouts.main')
@section('title', $blog->title)
@section('description', $blog->description)
@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-9">
            <h1 class="heading mb-5">{{ $blog->heading }}</h1>
            <div class="page-text">
                {!! $blog->text !!}
            </div>
        </div>
        <div class="col-xl-3">
            @include('partials.about')

            {!! App\Models\Banner::verticalBanner(null) !!}
        </div>
    </div>
</div>
@endsection

