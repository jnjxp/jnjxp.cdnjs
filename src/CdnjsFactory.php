<?php

namespace Jnjxp\Cdnjs;

use Psr\Container\ContainerInterface;

class CdnjsFactory
{
    public function __invoke(ContainerInterface $container) : Cdnjs
    {
        $config = $container->get('config-cdnjs');

        if (! isset($config['libraries'])) {
            throw new \Exception('No cdnjs libraries set');
        }

        return new Cdnjs(
            $container->get(Sri\StorageInterface::class),
            $config['libraries']
        );
    }
}
