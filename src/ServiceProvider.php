<?php namespace DeSmart\DomainCore;

use DeSmart\DomainCore\Commands\LocatorHandlerFactory;
use Illuminate\Bus\Dispatcher;
use Illuminate\Container\Container;

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
