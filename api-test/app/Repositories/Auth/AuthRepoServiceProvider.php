<?php
namespace App\Repositories\Auth;
use Illuminate\Support\ServiceProvider;

class AuthRepoServiceProvider extends ServiceProvider{
    public function boot(){}

    public function register(){
        $this->app->bind('App\Repositories\Auth\AuthInterface', 
        'App\Repositories\Auth\AuthRepository');
    }
}