<?php

declare(strict_types=1);

namespace Jnjxp\Cdnjs\Sri;

use Psr\Container\ContainerInterface;

class GeneratorFactory
{
    public function __invoke(ContainerInterface $container) : GeneratorInterface
    {
        return new Generator(
            $container->get(HttpInterface::class),
        );
    }
}
