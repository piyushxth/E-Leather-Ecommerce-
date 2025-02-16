<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Http\View\Composer\NavbarComposer;
use App\Http\View\Composer\WishlistComposer;
use App\Http\View\Composer\SettingComposer;
use App\Http\View\Composer\BannerComposer;
use App\Http\View\Composer\CategoryComposer;
use App\Http\View\Composer\SearchbarComposer;
use App\Http\View\Composer\CartComposer;

use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        View::composer("frontend.layouts.header", WishlistComposer::class);
        View::composer("frontend.layouts.header", CartComposer::class);
        View::composer("frontend.layouts.header", CategoryComposer::class);
        View::composer("frontend.layouts.header", SettingComposer::class);
        View::composer("frontend.layouts.footer", SettingComposer::class);
        View::composer("frontend.layouts.footer", CategoryComposer::class);
        View::composer("frontend.pages.home", SettingComposer::class);
        View::composer("frontend.pages.contact", SettingComposer::class);
        View::composer("frontend.pages.aboutus", SettingComposer::class);
        View::composer("frontend.pages.partials.sidesearch", SearchbarComposer::class);
        View::composer('frontend.layouts.master', function ($view) {
            $view->with('user_account', \Session::get('user') );    
        });  
    }
}