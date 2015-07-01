<?php namespace DeSmart\DomainCore\Command\Extractor\Contracts;

interface CommandNameExtractor
{
    /**
     * Extract the name from a command
     *
     * @param object $command
     * @return string
     */
    public function extract($command);
}
