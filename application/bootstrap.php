<?php
#uses
use Leviathan\Service\Locator;
use Respect\Rest\Router;
#includepath
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.'/library');
require __DIR__.'/library/Lyla/Common/Autoload.php';
require __DIR__.'/../vendor/autoload.php';
spl_autoload_register(Lyla\Common\Autoload::getInstance());

$config = json_decode(file_get_contents(__DIR__.'/settings/settings.json'),1);
new Locator($config);

$router = new Router;

$router->get('/phpinfo',function(){
    phpinfo();
});

$router->get('/test',function(){
    $pdo = Leviathan\Service\Locator::get('mapper:desaparecido');
    var_dump($pdo);
});

$router->any('/api/v1/data/desaparecido/*','\Lyla\Controller\Rest\Desaparecido')
    ->accept(['application/json'=>'json_encode']);