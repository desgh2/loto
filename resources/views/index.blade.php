@extends('layouts.main')
@section('content')
<div id="slider">
    <div class="row justify-content-end">
        <div class="col-md-5">
            <div class="slider-info">
                <h1>Играйте официально</h1>
                <p>в лотореи онлайн!</p>
                @php
                    $random = App\Models\Lottery::published()->take(1)->inRandomOrder()->first();
                @endphp
                <img src="{{ asset($random->image) }}" alt="">
                <span>{{ $random->currency }} {{ App\Classes\Helper::jackpot($random->jackpot) }}</span>
                <a href="{{ route('lottery', ['lottery' => $random->slug]) }}" class="btn btn-play">Играть</a>
                {{-- <img src="images/megabucks.png" alt="">
                <span>€ 42.3 млн</span>
                <a href="" class="btn btn-play">Играть</a> --}}
            </div>
        </div>
    </div>
</div><!-- /slider -->
<div id="carousel-loto" class="row">
    @foreach ($lottery as $loto)
    <div class="carousel-box col-md-3">
        <div class="in-carousel-box">
            <div class="cb-logo"><img src="{{ $loto->image }}" alt=""></div>
            <span class="cb-name">{{ $loto->name }}</span>
            <span class="cb-jackpot"><span class="ltj-cur">{{ $loto->currency }}</span>{{ App\Classes\Helper::jackpot($loto->jackpot) }}</span>
            <a href="{{ url('lottery/'.$loto->slug) }}" class="btn btn-play">Играть</a>
            <p>Закрытие через <timer :date="{{ $loto->countdown - time() }}"></timer> {{--<span> {{ App\Classes\Helper::timer($loto->countdown) }} </span>--}}</p>
        </div>
    </div>
    @endforeach
</div><!-- /carousel -->
<div id="faq">
    <div class="row">
        <div class="faq-box col-md-3">
        	<span class="lottery-icon lottery-icon-play"></span>
        	<p class="fb-name">Как играть</p>
        	<p class="fb-text">Выберите количество полей. Заполните каждое из них или используйте "Автовыбор".</p>
        	<a href="">Подробнее <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></a>
        </div>
        <div class="faq-box col-md-3">
            <span class="lottery-icon lottery-icon-dollar"></span>
            <p class="fb-name">Как оплачивать</p>
            <p class="fb-text">Выберите тип услуги и дополнительные опции, которые гарантированно увеличат ваш выигрыш.</p>
            <a href="">Подробнее <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></a>
        </div>
        <div class="faq-box col-md-3">
            <span class="lottery-icon lottery-icon-ticket"></span>
            <p class="fb-name">Как проверить</p>
            <p class="fb-text">Выберите разовое участие, либо оформите "Мультирозыгрыш" или "Подписку" на следующие тиражи.</p>
            <a href="">Подробнее <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></a>
        </div>
        <div class="faq-box col-md-3">
            <span class="lottery-icon lottery-icon-money"></span>
            <p class="fb-name">Получить выиграш</p>
            <p class="fb-text">Нажмите на кнопку "Далее", чтобы подтвердить и завершить оплату. Поздравляем, вы в игре!</p>
            <a href="">Подробнее <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></a>
        </div>
    </div>
</div><!-- /faq -->
</div><!-- /container -->
<div id="last-results">
    <div class="last-results-name">Последние результаты лоторей</div>
    <div class="container">
        <div class="row">
            <div class="last-lottery col-md-12">
                <div class="in-last-lottery">
                    <div class="lr-name">Результаты лоторей</div>
                    <table class="table table-last-lottery">
                        <thead>
                            <tr>
                                <th>Лоторея</th>
                                <th>Дата тиража</th>
                                <th>Результаты розыграша</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $row)
                            @php
                                $draw = json_decode($row->draw_result);
                            @endphp
                            <tr>
                              	<td class="lottery">

                              	    <img src="{{ asset($row->lottery->image) }}" alt="">
                              	    <span>{{ $row->name }}</span>
                              	</td>
                              	<td class="date">{{ date('d.m.Y', $row->close_date) }}</td>
                              	<td class="results">
                                    @if($draw)
                                     @foreach ($draw->regular as $regular)
                                        <span>{{ $regular }}</span>
                                    @endforeach
                                    @endif
                              	    @isset($draw->special)
                              	        @foreach ($draw->special as $special)
                              	            <span class="special">{{ $special }}</span>
                              	        @endforeach
                              	    @endisset
                              	    @isset($draw->bonusball)
                              	        @foreach ($draw->bonusball as $bonus)
                              	            <span class="bonus">{{ $bonus }}</span>
                              	        @endforeach
                                    @endisset
                                    @isset($draw->extra)
                                        <span class="extra">x{{$draw->extra }}</span>
                                    @endisset
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="ill-more"><a href="{{ route('results') }}">Все результаты</a></div>
                </div><!-- /in last lottery -->
            </div><!-- /last lottery -->
            {{-- <div class="last-winners col-md-3">
                <div class="in-last-winners">
                    <div class="lr-name">Победители</div>
                    <div class="last-winners-box">
                        <div class="lwb-name">
                            <span class="country"><img src="images/en.png" alt=""></span>
                            <span class="name">John Doe</span>
                        </div>
                        <div class="lwb-date">
                            <span class="lottery">PowerBall</span>
                            <span class="date">12.10.2020</span>
                        </div>
                        <div class="lwb-price">€ 1 800.00</div>
                    </div><!-- /last-winners-box -->
                    <div class="last-winners-box">
                        <div class="lwb-name">
                            <span class="country"><img src="images/usa.png" alt=""></span>
                            <span class="name">John Doe</span>
                        </div>
                        <div class="lwb-date">
                            <span class="lottery">PowerBall</span>
                            <span class="date">12.10.2020</span>
                        </div>
                        <div class="lwb-price">€ 1 800.00</div>
                    </div><!-- /last-winners-box -->
                    <div class="last-winners-box">
                        <div class="lwb-name">
                            <span class="country"><img src="images/au.png" alt=""></span>
                            <span class="name">John Doe</span>
                        </div>
                        <div class="lwb-date">
                            <span class="lottery">PowerBall</span>
                            <span class="date">12.10.2020</span>
                        </div>
                        <div class="lwb-price">€ 1 800.00</div>
                    </div><!-- /last-winners-box -->
                    <div class="last-winners-box">
                        <div class="lwb-name">
                            <span class="country"><img src="images/de.png" alt=""></span>
                            <span class="name">John Doe</span>
                        </div>
                        <div class="lwb-date">
                            <span class="lottery">PowerBall</span>
                            <span class="date">12.10.2020</span>
                        </div>
                        <div class="lwb-price">€ 1 800.00</div>
                    </div><!-- /last-winners-box -->
                    <div class="last-winners-box">
                        <div class="lwb-name">
                            <span class="country"><img src="images/pt.png" alt=""></span>
                            <span class="name">John Doe</span>
                        </div>
                        <div class="lwb-date">
                            <span class="lottery">PowerBall</span>
                            <span class="date">12.10.2020</span>
                        </div>
                        <div class="lwb-price">€ 1 800.00</div>
                    </div><!-- /last-winners-box -->
                </div>
            </div><!-- /last-winners --> --}}
        </div>
    </div><!-- /container -->
</div><!-- /last-results -->
<div class="container">
    @if (config('recommend'))
    <div id="recommend">
        <div class="recommend-name">Рекомендуемые лотореи</div>
        <div class="row justify-content-center">
            @foreach (App\Models\Lottery::recommends(config('recommend')) as $loto)
            <div class="recommend-box col-md-5">
                <div class="in-recommend-box">
                    <div class="irb-top">
                        <span class="img"><img src="{{ $loto->image }}" alt=""></span>
                        <span class="price"><span style="font-size: 16px; margin-right: 5px;">{{ $loto->currency }}</span>{{ App\Classes\Helper::jackpot($loto->jackpot) }}</span>
                    </div>
                    <div class="irb-bottom">
                        <a href="{{ url('lottery/'.$loto->slug) }}">Играть</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div><!-- /recommend -->
    @endif
    <div id="text">
        {!! $setting->text !!}
    </div>
</div>
@endsection
@push('scripts')
<script defer src="{{ asset('js/slick.js') }}"></script>
<script defer src="{{ asset('js/slider.js') }}"></script>
<script src="{{ asset('js/timer.js') }}"></script>
@endpush
