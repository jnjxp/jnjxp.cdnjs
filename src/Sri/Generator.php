<?php

namespace Jnjxp\Cdnjs\Sri;

use Jnjxp\Cdnjs\Assets;

class Generator implements GeneratorInterface
{
    const API = 'https://api.cdnjs.com/libraries/%s';

    protected $http;

    public function __construct(HttpInterface $http)
    {
        $this->http = $http;
    }

    public function getSri($name, $version) : array
    {
        $library = $this->library($name);
        $files   = $this->files($library, $version);
        $assets  = new Assets($name, $version);

        $sri = [];
        foreach ($files as $file) {
            $url  = $assets->url($file);
            $content = $this->http->getFile($url);
            $sri[$file] = $this->checksum($content);
        }
        return $sri;
    }

    protected function library($name) : object
    {
        $url = sprintf(self::API, $name);
        return $this->http->getJson($url);
    }

    protected function files(object $library, $version) : array
    {
        foreach ($library->assets as $cur) {
            if ($version == $cur->version) {
                return $cur->files;
            }
        }
        throw new \Exception("Version not found: $version");
    }

    protected function checksum(string $data) : string
    {
        $hash = hash('sha256', $data, true);
        $hash = base64_encode($hash);
        return "sha256-$hash";
    }
}
