<?php
namespace Lyla\Common;

class Autoload
{

    protected static $instance;

    protected function __construct()
    {
        
    }

    public function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __invoke($className)
    {
        $fileParts = explode('\\', ltrim($className, '\\'));
        foreach ($fileParts as $index => $part) {
            $fileParts[$index] = ucfirst($part);
        }
        if (false !== strpos(end($fileParts), '_')) {
            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));
        }
        $fileParts = implode(DIRECTORY_SEPARATOR, $fileParts);
        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
            $file = $path . DIRECTORY_SEPARATOR . $fileParts . '.php';
            if (is_file($file)) {
                require $file;
                return true;
            }
        }
        return false;
    }
}
