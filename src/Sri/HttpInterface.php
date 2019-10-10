<?php

namespace Jnjxp\Cdnjs\Sri;

interface HttpInterface
{
    public function getFile($url) : string;

    public function getJson($url) : object;
}
