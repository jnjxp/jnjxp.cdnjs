<?php

namespace Jnjxp\Cdnjs\Console;

use Jnjxp\Cdnjs\Sri;

class GenerateSri
{
    protected $storage;

    protected $generator;

    protected $libraries;

    public function __construct(
        Sri\StorageInterface $storage,
        Sri\GeneratorInterface $generator,
        array $libraries = []
    ) {
        $this->storage = $storage;
        $this->generator = $generator;
        $this->libraries = $libraries;
    }

    public function execute()
    {
        $this->storeAll($this->libraries);
        return true;
    }

    public function storeSri(string $name, $version)
    {
        echo "Processing $name $version" . PHP_EOL;
        $key = $name . '_' . $version;
        $sri = $this->generator->getSri($name, $version);
        $this->storage->set($key, $sri);
    }

    public function storeAll(array $specs)
    {
        foreach ($specs as $spec) {
            $this->storeSri($spec['name'], $spec['version']);
        }
    }
}
