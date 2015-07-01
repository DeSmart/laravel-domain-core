<?php namespace DeSmart\DomainCore\Command\Extractor;

use DeSmart\DomainCore\Command\Extractor\Contracts\CommandNameExtractor;

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
