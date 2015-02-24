<?php namespace DeSmart\DomainCore;

use DeSmart\DomainCore\Contracts\EntityTranslatorInterface;

class EntityTranslator implements EntityTranslatorInterface
{

    public function fromModel($model)
    {
        $model_class = get_class($model);

        return preg_replace('/Model\\\\(\w+)/', 'Entity\\\\$1Entity', $model_class);
    }
}
