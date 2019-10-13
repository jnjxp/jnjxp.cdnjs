<?php

namespace Jnjxp\Cdnjs;

use Psr\Container\ContainerInterface;

class HelperFactory
{
    public function __invoke(ContainerInterface $container) : Helper
    {
        return new Helper($container->get(Cdnjs::class));
    }
}
