<?php

// Directory of classes
define('APP', realpath(dirname(__FILE__)).'/');

define('APP_URI', '/lyla/');

// Autoload classes
function __autoload($className)
{
	$fileName = APP.$className.'.php';
	
	if(! file_exists($fileName))
	{
		throw new Exception('Class '.$className.' not found!');
	}
	
	include $fileName;
}

$request = new \Core\Request;

echo $request->process()->response()->body();