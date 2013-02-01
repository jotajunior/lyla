<?php
#uses

#includepath
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.'/library');
require __DIR__.'/library/Lyla/Common/Autoload.php';
require __DIR__.'/../vendor/autoload.php';
spl_autoload_register(Lyla\Common\Autoload::getInstance());

$router = new Respect\Rest\Router;

$router->get('/phpinfo',function(){
    phpinfo();
});