<?php

namespace Jnjxp\Cdnjs\Sri;

interface StorageInterface
{
    public function get(string $name) : ?array;

    public function has(string $name) : bool;

    public function set(string $name, array $data) : bool;
}
