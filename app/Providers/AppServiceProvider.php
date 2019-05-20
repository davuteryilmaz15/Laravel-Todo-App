<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;

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
        //[Illuminate\Database\QueryException] SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes (SQL: alter table users add unique users_email_unique(email))
        Schema::defaultStringLength(191); //To fix above error

        //Form components
        $this->app['form']->component('bsText', 'form_components.text', ['name', 'label_name' => null, 'value' => null, 'attributes' => []]);
        $this->app['form']->component('bsPassword', 'form_components.password', ['name', 'label_name', 'attributes' => []]);
        $this->app['form']->component('bsSubmit', 'form_components.submit', ['name', 'url' => URL::previous()]);
        $this->app['form']->component('bsDate', 'form_components.date', ['name', 'label_name' => null, 'value' => null, 'attributes' => []]);
    }
}
