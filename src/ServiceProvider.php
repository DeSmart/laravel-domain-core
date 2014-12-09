<?php namespace DeSmart\DomainCore;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        $this->app->bind('DeSmart\DomainCore\EntityTranslatorInterface', 'DeSmart\DomainCore\EntityTranslator');
    }
}
