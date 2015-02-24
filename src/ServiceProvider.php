<?php namespace DeSmart\DomainCore;

use Illuminate\Bus\Dispatcher;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot(Dispatcher $dispatcher)
    {
        $dispatcher->pipeThrough(['ValidateCommand'])
            ->mapUsing(function ($command) {
                $mapper = new BasicCommandMapper();
                return $mapper->toCommandHandler($command);
            });
    }

    public function register()
    {
        $this->app->bind('DeSmart\DomainCore\EntityTranslatorInterface', 'DeSmart\DomainCore\EntityTranslator');
    }
}
