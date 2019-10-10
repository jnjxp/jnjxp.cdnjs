<?php

namespace Jnjxp\Cdnjs\Console;

use Jnjxp\Cdnjs\Sri;

use Psr\Container\ContainerInterface;

class GenerateSriFactory
{
    public function __invoke(ContainerInterface $container) : GenerateSri
    {
        $config = $container->get('config-cdnjs');

        if (! isset($config['libraries'])) {
            throw new \Exception('No cdnjs libraries set');
        }

        return new GenerateSri(
            $container->get(Sri\StorageInterface::class),
            $container->get(Sri\GeneratorInterface::class),
            $config['libraries']
        );
    }
}
