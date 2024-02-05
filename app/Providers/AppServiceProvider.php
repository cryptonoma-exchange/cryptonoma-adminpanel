<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Tradepair;
use App\Models\AdminProfile;
use App\Models\Admin;
use App\Models\Kyc;
use View;
use App\Models\Liquidity;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $guard)
    {
        $this->app->bind("binance", function ($app) {
            $apikey = "Vkb4b5v86ZX6jYfF69vPNDX7d8ygyvevSL6HAWb1NDx79zKVsKVYGOHZeHYPh6VG";
            $secret = "U5h1dL3UZ2bqXAzx6B3slCjkLaY8iKjXdEJcKQX0luYkZzJIURmuvIUNTdKQzBbc";
            return new \Binance\API($apikey, $secret, true);

            // $liquidity = Liquidity::first();
            // $apikey = $liquidity->apikey;
            // $secret = $liquidity->secretkey;
            // return new \Binance\API($apikey,$secret);
        });

        Builder::macro('withWhereHas', function($relation, $constraint){ 
            return $this->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
        });
        View::composer('*', function ($view) use ($guard) {

            $pair = Tradepair::first();

            $Admindetails        = Admin::where('id', \Session::get('adminId'))->first();
            $AdminProfiledetails = AdminProfile::where('user_id', \Session::get('adminId'))->first();
            $kyc_count           = Kyc::on('mysql2')->where('status', '=', 0)->count();

            $Admindetails = Admin::where('id', \Session::get('adminId'))->first();
            $AdminProfiledetails = AdminProfile::adminprofile();

            $view->with('Admindetails', $Admindetails)->with('AdminProfiledetails', $AdminProfiledetails)->with('pair', $pair)->with('kyc_count', $kyc_count)->with('Admindetails', $Admindetails)->with('AdminProfiledetails', $AdminProfiledetails);
        });

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
