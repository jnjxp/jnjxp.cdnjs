<?php

namespace Jnjxp\Cdnjs\Sri;

interface GeneratorInterface
{
    public function getSri($name, $version) : array;
}
