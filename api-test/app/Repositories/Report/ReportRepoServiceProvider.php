<?php
namespace App\Repositories\Report;
use Illuminate\Support\ServiceProvider;

class ReportRepoServiceProvider extends ServiceProvider{
    public function boot(){}

    public function register(){
        $this->app->bind('App\Repositories\Report\ReportInterface', 
        'App\Repositories\Report\ReportRepository');
    }
}