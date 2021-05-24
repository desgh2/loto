<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->name('index');
Route::get('play', function (){
    return view('pages.play');
})->name('page.play');
Route::get('/lottery', 'LotteryController@all')->name('lotteries');
Route::get('/lottery/{lottery:slug}', 'LotteryController@lottery')->name('lottery');
Route::get('/results', 'LotteryController@results')->name('results');
Route::get('/results/{slug}', 'LotteryController@result')->name('result');

Route::get('blog', 'BlogController@index')->name('blogs');
Route::get('blog/{blog:slug}', 'BlogController@show')->name('blog');

Route::get('page', 'PageController@index')->name('pages');
Route::get('page/{page:slug}', 'PageController@show')->name('page');

Route::group(['prefix' => 'dashboard','middleware' => ['auth:sanctum', 'verified']], function() {
	Route::get('/', function(){
    	#return view('dashboard');
        return redirect()->route('lottery.index');
    })->name('dashboard');
    //лотореи
    Route::get('lottery/add', 'Admin\LotteryController@add')->name('lottery.add');
    Route::get('lottery/{lottery}/refresh', 'Admin\LotteryController@refresh')->name('lottery.refresh');
    Route::get('lottery/refresh/all', 'Admin\LotteryController@refresh_all')->name('lottery.refresh_all');
    Route::resource('lottery', 'Admin\LotteryController');
    Route::post('lottery/{lottery}/status', 'Admin\LotteryController@status')->name('lottery.status');
    //результаты
    Route::get('result/add', 'Admin\ResultController@add')->name('result.add');
    Route::resource('result', 'Admin\ResultController');
    //настройки сайта
    Route::get('setting', 'Admin\SettingController@index')->name('setting.index');
    Route::post('setting/store', 'Admin\SettingController@store')->name('setting.store');
    Route::post('setting/update/{setting}', 'Admin\SettingController@update')->name('setting.update');

    /**
     * Страницы
     */
    Route::resource('page', 'Admin\PageController');
    Route::post('page/{page}/status', 'Admin\PageController@status')->name('page.status');

    /**
     * Блог
     */
    Route::resource('blog', 'Admin\BlogController');
    Route::post('blog/{blog}/status', 'Admin\BlogController@status')->name('blog.status');

    /**
     * Беннеры
     */
    Route::resource('banner', 'Admin\BannerController');
});
/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/
