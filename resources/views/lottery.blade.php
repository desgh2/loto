@extends('layouts.main')
@section('title', $lottery->name)
@section('description', )
@section('content')
<div class="content">
	<div class="row">
		<div class="col-xl-9">
			<h1 class="heading">{{ $lottery->name }}</h1>
			<div class="lottery-top" style="border: 1px solid #badafb; padding: 20px; background-color: #dfefff; margin: 15px 0;">
				<div class="row">
					<div class="lt-img col-xl-3 text-center">
						<img src="{{ $lottery->image }}" width="100px" alt="">
					</div>
					<div class="lt-rating col-xl-3 text-center">
						<div class="in-ltr">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
							<span>{{ round($lottery->rating) }}</span>
						</div>
					</div>
					<div class="lt-time col-xl-2 text-center">
						<timer :date="{{ $lottery->countdown - time() }}"></timer>
					</div>
					<div class="lt-jackpot col-xl-4 text-center">
						<span class="ltj-cur">{{ $lottery->currency }}</span><span>{{ App\Classes\Helper::jackpot($lottery->jackpot) }}</span>
					</div>
				</div>
			</div>
			<div class="text">
				{!! $lottery->ticket !!}
				{!! $lottery->text !!}
			</div>
		</div>
		<div class="col-xl-3">
			@include('partials.about')

            {!! App\Models\Banner::verticalBanner($lottery->loto_id) !!}
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/timer.js') }}"></script>
@endpush
