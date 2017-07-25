<?php
/**
 * Created by Aliensdesign.
 * User: Aliensdesign
 * Date: 28/03/2017
 * Time: 14:38
 */
require  __DIR__.'/autoload.php';

require __DIR__ . '/routing.php';


/*
 * load controller
 */
$controller = (@$routes[1])? ucfirst($routes[1]).'Controller' : 'HomeController' ;
$method     = (@$routes[2] AND $routes[2] != $routes[1])? $routes[2] : 'index' ;

if(file_exists(__DIR__.'/app/controllers/'.$controller.'.php'))
{
    $namespace = '\\app\\controllers\\'.$controller;
    $class = call_user_func([new $namespace(),$method]);
}
else
{
    http_response_code(404);
//    include('my_404.php'); // provide your own HTML for the error page
    die('Erro 404');
}
