<?php namespace DeSmart\DomainCore\Commands\Extractor;

use DeSmart\DomainCore\Commands\Extractor\Contracts\CommandNameExtractor;

class ClassNameExtractor implements CommandNameExtractor
{
    /**
     * Extract the name from a command
     *
     * @param object $command
     * @return string
     */
    public function extract($command)
    {
        return get_class($command);
    }
}
