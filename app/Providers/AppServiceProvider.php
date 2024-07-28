<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categories as Categories;

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
        // Đăng ký view composer để chia sẻ dữ liệu với tất cả các view
        View::composer('*', function ($view) {
            $categories = Categories::Category(); 
            $categories = Categories::where('status','=','active')->get();
            $view->with('categories', $categories);
        });
    }
}
