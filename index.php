<?php

// Directory of classes
define('APP', realpath(dirname(__FILE__)) . '/');

define('APP_URI', '/');

set_include_path(get_include_path().PATH_SEPARATOR.__DIR__);

spl_autoload_register(function($className) {
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
});
$request = new \Core\Request;

echo $request->process()->response()->body();