<?php


/*
 * Defining app rooit dir
 */
//define("BASE_URL", 'http://dev.buscadenomes.com.br/');
define("BASE_URL", 'http://dev.buscadenomes.com.br/');

/*
The following function will strip the script name from URL i.e.  http://www.something.com/search/book/fitzgerald will become /search/book/fitzgerald
*/
function getCurrentUri()
{
    /* Get application root folder and remove from index.php script name */
    $currentdir = strtolower(basename(__DIR__));
    $requesturi = explode('/',$_SERVER['REQUEST_URI']);
    $scriptname = explode('/', $_SERVER['SCRIPT_NAME']);
    $keytoremove = array_search($currentdir,$requesturi);
    $keytoremovescript = array_search($currentdir,$scriptname);
    unset($requesturi[$keytoremove]);
    unset($scriptname[$keytoremovescript]);

   /* $basepath = implode('/', array_slice($scriptname, 0, -1)) . '/';*/
    $uri = implode('/',$requesturi);
    if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
    $uri = '/' . trim($uri, '/');
    return $uri;
}

$base_url = getCurrentUri();
$routes = array();
$routes = explode('/', $base_url);
foreach ($routes as $route) {
    if (trim($route) != '')
        array_push($routes, $route);
}
