<?php

declare(strict_types=1);

namespace Jnjxp\Cdnjs;

use Phly\Expressive\ConfigFactory;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'plates'       => $this->getPlatesConfig(),
        ];
    }

    public function getDependencies() : array
    {
        return [
            'invokables' => [
                Sri\HttpInterface::class => Sri\Http::class
            ],
            'factories'  => [
                'config-cdnjs' => ConfigFactory::class,
                Cdnjs::class => CdnjsFactory::class,
                Console\GenerateSri::class => Console\GenerateSriFactory::class,
                Sri\GeneratorInterface::class => Sri\GeneratorFactory::class,
                Sri\StorageInterface::class => Sri\StorageFactory::class,
                Helper::class => HelperFactory::class,
            ],
        ];
    }

    public function getPlatesConfig() : array
    {
        return [
            'extensions' => [
                Helper::class,
            ]
        ];
    }
}
