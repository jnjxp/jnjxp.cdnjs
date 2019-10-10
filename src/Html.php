<?php

namespace Jnjxp\Cdnjs;

class Html
{
    const SCRIPT = '<script src="%s" %s crossorigin="anonymous"></script>';

    const LINK = '<link rel="stylesheet" href="%s" %s crossorigin="anonymous" />';

    protected $assets;

    protected $sri;

    public function __construct(Assets $assets, array $sri = [])
    {
        $this->assets = $assets;
        $this->sri = $sri;
    }

    protected function format($pattern, $asset)
    {
        $integrity = isset($this->sri[$asset])
            ? sprintf(' integrity="%s" ', $this->sri[$asset])
            : '';

        return sprintf(
            $pattern,
            $this->assets->url($asset),
            $integrity
        );
    }

    public function script($asset)
    {
        return $this->format(self::SCRIPT, $asset);
    }

    public function link($asset)
    {
        return $this->format(self::LINK, $asset);
    }

    public function tag($asset)
    {
        $ext = pathinfo($asset, PATHINFO_EXTENSION);
        switch ($ext) {
            case 'js':
                return $this->script($asset);
                break;
            case 'css':
                return $this->link($asset);
                break;
            default:
                throw new \Exception("Unknown type $asset");
                break;
        }
    }
}
