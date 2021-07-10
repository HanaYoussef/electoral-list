<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;
use App\Models\Category;
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
        //
        Paginator::useBootstrap();

        //$cat=DB::table('categories')->get();
        $cat=Category::all();
        // $cat=DB::table('categories')->get();
        $cat=Category::get();
        /*$postPupular = \DB::table('posts')
                        ->orderByRaw('count DESC')->take(3)->get();*/
     $postPopular = Post::orderByRaw('count DESC')->take(3)->get();
        View::share(['cat'=>$cat ,
                    'postPopular'=> $postPopular]);  
    }
}
