@extends('layouts.main')
@section('title', 'Results')
@section('description', 'Description')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-9">
            <h1 class="heading">Last results {{ $lottery->name }}</h1>
            <div class="text">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Dolore velit tempora, dicta nesciunt unde aliquid atque minima ipsum non amet.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit numquam sequi fugit quae nesciunt consectetur mollitia qui, tenetur, itaque! Ex quia odio laboriosam obcaecati delectus.</p>
            </div>
            <table class="table table-bordered table-latest">
                <thead>
                    <tr>
                        <th>Лотерея</th>
                        <th>Дата розыграша</th>
                        <th>Выиграшные номера</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($lottery->results as $loto)
                @php
                    $draw = json_decode($loto->draw_result);
                @endphp
                    <tr>
                        <td class="name"><img width="50px" src="{{ $loto->image }}" alt=""><a href="{{ route('lottery', ['lottery' => $lottery]) }}">{{ $loto->name }}</a></td>
                        <td class="date">{{ date('d.m.Y', $loto->close_date) }}</td>
                        <td class="results">
                            @isset($draw->regular)
                            @foreach ($draw->regular as $regular)
                                <span>{{ $regular }}</span>
                            @endforeach
                            @endisset
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
        </div>
        <div class="col-xl-3">
            @include('partials.about')

            {!! App\Models\Banner::verticalBanner(null) !!}
        </div>
    </div>
</div>


@endsection
