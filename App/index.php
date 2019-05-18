<?php
// Default allow requests from everywhere. You can remove it if you want
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

require 'Core/constants.php';
#require __DIR__ . '/vendor/autoload.php';

use PRACTICA\App\Controllers;

echo $uri = $_SERVER['REQUEST_URI'];

if ($uri == '/') {
    $response = ['response' => 'No content to show'];
    echo json_encode($response);
    exit;
}

$src        = explode('/', $uri);
$model      = "menu";//ucfirst($src[1]);
$controller = $model . 'Controller';
$method  = 'index';

if (isset($src[3]) && empty($the_request)) {
    $the_request = filter_var($src[3], FILTER_SANITIZE_STRING);
}

/*
* call current class/method
*/
try {
   $load_class = 'PRACTICA\App\Controller\\' . $controller;
   $class      = new $load_class();
    $set        = $class->$method($the_request);
    var_dump($set);
} catch (Exception $e) {
    echo 'No ' . $controller . ' found for this route', $e->getMessage(), "\n";
}

/*
* Declare all variables if passed in return
*/
if ( ! empty($set) && is_array($set)) {
    foreach ($set as $k => $v) {
        ${$k} = $v;
    }
}

// /*
// * If method has a view file, include
// */
// $view_file = APP_VIEW . $model . DS . $method . PHP;

// if (file_exists($view_file)) {
//     include $view_file;
// }
