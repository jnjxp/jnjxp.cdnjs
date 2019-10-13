<?php

namespace Jnjxp\Cdnjs;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class Helper implements ExtensionInterface
{
    protected $cdnjs;

    public function __construct(Cdnjs $cdnjs)
    {
        $this->cdnjs = $cdnjs;
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('cdnjs', [$this->cdnjs, 'get']);
    }
}
