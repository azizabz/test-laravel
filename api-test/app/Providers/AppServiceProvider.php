<?php

namespace App\Providers;

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
        $this->app->bind('League\Fractal\Manager', function ($app) {
            $manager = new \League\Fractal\Manager;

            // Use the serializer of your choice.
            $manager->setSerializer(new \App\Serializers\CustomSerializer);

            return $manager;
        });
    }
}
