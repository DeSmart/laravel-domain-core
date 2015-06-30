<?php namespace DeSmart\DomainCore;

use DeSmart\DomainCore\Commands\LocatorHandlerFactory;
use Illuminate\Bus\Dispatcher;
use Illuminate\Container\Container;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        $this->app->bind('DeSmart\DomainCore\EntityTranslatorInterface', 'DeSmart\DomainCore\EntityTranslator');

        $this->app->bind(
            'DeSmart\DomainCore\Commands\Contracts\CommandBus',
            'DeSmart\DomainCore\Commands\CommandBus'
        );

        $this->app->bind(
            'DeSmart\DomainCore\Commands\Factory\Contracts\HandlerLocator',
            'DeSmart\DomainCore\Commands\Factory\HandlerLocatorFactory'
        );

        $this->app->bind(
            'DeSmart\DomainCore\Commands\Factory\Contracts\ValidatorLocator',
            'DeSmart\DomainCore\Commands\Factory\ValidatorLocatorFactory'
        );

        $this->app->bind(
            'DeSmart\DomainCore\Commands\Extractor\Contracts\CommandNameExtractor',
            'DeSmart\DomainCore\Commands\Extractor\ClassNameExtractor'
        );
    }
}
