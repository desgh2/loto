<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', $setting->title)</title>
        <meta name="description" content="@yield('description', $setting->description)">
        <!-- styles -->
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
        @if (\Request::is('/'))<link rel="stylesheet" href="{{ asset('css/slick.css') }}"> @endif
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <div id="app">
            <header>
                <nav class="navbar navbar-expand-md bg-white">
                    <div class="container">
                        <!-- Brand -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/logotype.png') }}" alt="">
                        </a>
                        <!-- Toggler/collapsibe Button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Navbar links -->
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                            <ul class="header-nav navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('lotteries') }}">Лотереи</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('results') }}">Результаты</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blogs') }}">Блог</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('page.play') }}">Как играть</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Акции</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                <div class="container">
                    @yield('content')
                </div><!-- /container -->
            </main>
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <hr>
                            Согласно №138-ФЗ "О лотереях" сайт lottery.broker не является организатором, оператором, распространителем лотерей. А также не занимается организацией, проведением лотерей.
                        </div>
                    </div>
                </div>
                <div id="footer">
                    <div class="container">
                        <div class="row">
                            <div class="footer-leftcol-md-4">
                                <a href=""><img src="{{ asset('images/logotype.png') }}" alt=""></a>
                                <div class="ages">
                                    <span>18+</span>
                                </div>
                            </div>
                            <div class="footer-right col-md-8">
                                <div class="in-footer-right">
                                    <ul class="footer-menu">
                                        <li><a href="{{ route('lotteries') }}">Лотереи</a></li>
                                        <li><a href="{{ route('results') }}">Результаты</a></li>
                                        <li><a href="{{ route('blogs') }}">Блог</a></li>
                                        <li><a href="{{ route('page.play') }}">Как играть</a></li>
                                        <li><a href="#">Акции</a></li>
                                    </ul>
                                    <div class="row">
                                        <div class="second-footer-menu col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-7 offset-lg-5">
                                                    <ul class="d-flex justify-content-between">
                                                    @foreach (App\Models\Page::whereIn('id', [1,4,5,6])->get() as $page)
                                                        <li><a href="{{ route('page', ['page' => $page->slug]) }}">{{ $page->name }}</a></li>
                                                    @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-lg-8 offset-lg-4">
                                                    <ul class="d-flex justify-content-between">
                                                    @foreach (App\Models\Page::whereNotIn('id', [1,4,5,6])->get() as $page)
                                                        <li><a href="{{ route('page', ['page' => $page->slug]) }}">{{ $page->name }}</a></li>
                                                    @endforeach
                                                    </ul>
                                                </div>
                                                {{-- <div class="col-lg-8 offset-lg-4">
                                                    @foreach (array_chunk(App\Models\Page::whereNotIn('id', [1,4,5,6])->get()->toArray(), 4) as $pages)
                                                        <ul class="col-6">
                                                        @foreach ($pages as $row)
                                                            <li><a href="{{ route('page', ['page' => $row['slug']]) }}">{{ $row['name'] }}</a></li>
                                                        @endforeach
                                                        </ul>
                                                    @endforeach
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="footer-list">
                                        <li><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/></svg><span>{{ $setting->email }}</span></li>
                                        <li><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg><span>{{ $setting->phone }}</span></li>
                                        <li><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.166 8.94C12.696 7.867 13 6.862 13 6A5 5 0 0 0 3 6c0 .862.305 1.867.834 2.94.524 1.062 1.234 2.12 1.96 3.07A31.481 31.481 0 0 0 8 14.58l.208-.22a31.493 31.493 0 0 0 1.998-2.35c.726-.95 1.436-2.008 1.96-3.07zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/><path fill-rule="evenodd" d="M8 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg><span>{{ $setting->address }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copy">
                    © 2012-2020
                </div>
            </footer>
        </div>
    </div>
    <!-- scripts -->
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    @stack('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
