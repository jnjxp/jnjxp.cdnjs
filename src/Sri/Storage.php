<?php

namespace Jnjxp\Cdnjs\Sri;

class Storage implements StorageInterface
{
    protected $root;

    public function __construct(string $root)
    {
        $this->root = realpath($root);
        if (! $this->root) {
            throw new \Exception("Invalid root: $root");
        }
    }

    protected function path(string $name) : string
    {
        return $this->root . '/' . $this->slug($name) . '.json';
    }

    protected function slug(string $name) : string
    {
        $name = preg_replace('/[^a-z0-9-_]+/', '-', strtolower($name));
        $name = preg_replace("/-+/", '-', $name);
        $name = preg_replace("/_+/", '-', $name);
        $name = trim($name, '-');
        return $name;
    }

    public function get($name) : ?array
    {
        if (! $this->has($name)) {
            return null;
        }
        $path = $this->path($name);
        $data = file_get_contents($path);
        return json_decode($data, true);
    }

    public function has($name) : bool
    {
        $path = $this->path($name);
        return file_exists($path);
    }

    public function set($name, array $data) : bool
    {
        $path = $this->path($name);
        $data = json_encode($data);
        return file_put_contents($path, $data) > 0;
    }
}
