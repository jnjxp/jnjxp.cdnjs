<?php

namespace Jnjxp\Cdnjs;

class Assets
{
    const URL = 'https://cdnjs.cloudflare.com/ajax/libs/%s/%s/%s';

    protected $lib;

    protected $version;

    public function __construct(string $lib, string $version)
    {
        $this->lib = $lib;
        $this->version = $version;
    }

    public function url($asset)
    {
        return sprintf(self::URL, $this->lib, $this->version, $asset);
    }
}
