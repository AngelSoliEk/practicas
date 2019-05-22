<?php
// Default allow requests from everywhere. You can remove it if you want
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
error_reporting(E_ALL);
ini_set("display_errors", "On");

require '../constants.php';

$uri = $_SERVER['REQUEST_URI'];

if ($uri == '/') {
    $response = ['response' => 'No content to show'];
    echo json_encode($response);
    exit;
}

$src        = explode('/', $uri);
$model      = ucfirst($src[3]);
$controller = $model . 'Controller';

if (isset($src[4])) {
    $method = $src[4];
}

if (isset($src[5]) && empty($the_request)) {
    $the_request = filter_var($src[5], FILTER_SANITIZE_STRING);
}

/*
* call current class/method
*/
try {
    $load_class = FULL_APP_CONTROLLERS . $controller;
    include_once $load_class . PHP;
    $class = new $controller();
    $set = $class->$method($the_request);
    var_dump($set);
} catch (Exception $e) {
    echo 'No ' . $controller . ' found for this route', $e->getMessage(), "\n";
}

/*
* Declare all variables if passed in return
*/
if (!empty($set) && is_array($set)) {
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
