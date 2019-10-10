<?php

declare(strict_types=1);

namespace Jnjxp\Cdnjs\Sri;

use Psr\Container\ContainerInterface;

class StorageFactory
{
    public function __invoke(ContainerInterface $container) : StorageInterface
    {
        $config = $container->get('config-cdnjs');

        if (! isset($config['data'])) {
            throw new \Exception('No cdnjs.data set');
        }

        return new Storage($config['data']);
    }
}
