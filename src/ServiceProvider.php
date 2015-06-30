<?php namespace DeSmart\DomainCore;

use Illuminate\Bus\Dispatcher;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot(Dispatcher $dispatcher)
    {
    }

    public function register()
    {
        $this->app->bind('DeSmart\DomainCore\EntityTranslatorInterface', 'DeSmart\DomainCore\EntityTranslator');
    }
}
