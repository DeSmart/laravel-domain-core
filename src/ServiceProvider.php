<?php namespace DeSmart\DomainCore;

use DeSmart\DomainCore\Contracts\EntityTranslatorInterface;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->bind(EntityTranslatorInterface::class, EntityTranslator::class);
    }
}
