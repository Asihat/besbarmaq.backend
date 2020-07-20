<?php

namespace App\Providers;

use App\Functional\Accounts\Account;
use App\Functional\Accounts\IAccount;
use App\Functional\Chief\Chief;
use App\Functional\Chief\IChief;
use App\Functional\Lenta\ILenta;
use App\Functional\Lenta\Lenta;
use App\Functional\Order\IOrder;
use App\Functional\Order\Order;
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
        $this->app->bind(IAccount::class, Account::class);
        $this->app->bind(ILenta::class, Lenta::class);
        $this->app->bind(IOrder::class, Order::class);
        $this->app->bind(IChief::class, Chief::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
