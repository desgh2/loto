@extends('layouts.main')
@section('title', $page->title)
@section('description', $page->description)
@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-9">
            <h1 class="heading mb-5">{{ $page->heading }}</h1>
            <div class="page-text">
                {!! $page->text !!}
            </div>
        </div>
        <div class="col-xl-3">
            @include('partials.about')

            {!! App\Models\Banner::verticalBanner(null) !!}
        </div>
    </div>
</div>
@endsection

