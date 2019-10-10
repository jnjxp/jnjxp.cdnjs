<?php

namespace Jnjxp\Cdnjs;

class Cdnjs
{
    protected $specs;

    protected $sri;

    public function __construct(
        Sri\StorageInterface $sri,
        array $libraries = []
    ) {
        $this->sri = $sri;
        $this->specs = $libraries;
    }

    public function get($name)
    {
        $spec = $this->spec($name);
        $assets = $this->assets($spec);
        $sri = $this->sri($spec);
        return new Html($assets, $sri);
    }

    protected function spec($name) : array
    {
        $spec = $this->specs[$name];
        if (! isset($spec['name'])) {
            throw new \Exception("Spec '$name' as no `name`");
        }

        if (! isset($spec['version'])) {
            throw new \Exception("Spec '$name' as no `version`");
        }

        return $spec;
    }

    protected function assets(array $spec)
    {
        return new Assets($spec['name'], $spec['version']);
    }

    protected function sri(array $spec)
    {
        return $this->sri->has($spec['name'] . '_' . $spec['version'])
            ? $this->sri->get($spec['name'] . '_' . $spec['version'])
            : [];
    }
}
