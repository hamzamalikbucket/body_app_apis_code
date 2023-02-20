<?php

namespace App\Providers;

use App\Models\ContactUs;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('admin.dashboard',function($view){
            $totalAppUsers = User::where('role','user')->count();
            $totalContactUs = ContactUs::all()->count();
            $totalCourses = Course::all()->count();
            $totalMonthOrders = Order::whereMonth('created_at',Carbon::now()->month)->get()->count();

            $view->with('totalAppUsers',$totalAppUsers)->with('totalContactUs',$totalContactUs)
                ->with('totalCourses',$totalCourses)->with('totalMonthOrders',$totalMonthOrders);
        });
    }
}
