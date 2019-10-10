<?php

namespace Jnjxp\Cdnjs\Sri;

class Http implements HttpInterface
{
    public function getFile($url) : string
    {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($handle);
        curl_close($handle);
        return $data;
    }

    public function getJson($url) : object
    {
        return json_decode($this->getFile($url));
    }
}
