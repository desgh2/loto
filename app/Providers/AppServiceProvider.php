<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * Настройки сайта
         * $setting object
         */
        view()->composer('*', function($view) {
            $setting = optional(Setting::first());
            $pages = Page::published()->get();
            #$menu = Category::with('subcategories')->published()->get();
            $view->with('setting', $setting)->with('pages', $pages);
        });

        // $setting = Setting::find(1);
        // config([
        //     'title'         => $setting->title,
        //     'description'   => $setting->description,
        //     'heading'       => $setting->heading,
        //     'text'          => $setting->text,
        //     'lottery'       => $setting->lottery_count,
        //     'result'        => $setting->result_count,
        //     'recommend'     => json_decode($setting->recommend),
        //     'address'       => $setting->address,
        //     'email'         => $setting->email,
        //     'phone'         => $setting->phone,
        // ]);
        Schema::defaultStringLength(191);
    }
}
