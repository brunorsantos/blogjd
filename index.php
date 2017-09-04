<?php

require 'vendor/autoload.php';
require 'core/Bootstrap.php';


//require 'routes.php';

//dd($_SERVER);
use Src\Core\Router;
use Src\Core\Request;

$uri = trim(
	parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'
	);
$method = $_SERVER['REQUEST_METHOD'];

if ('PUT' == $method) {
    parse_str(file_get_contents("php://input"),$post_vars);
    Request::setParameters($post_vars);
}
if ('POST' == $method) {
	Request::setParameters($_POST);
}






Router::load('routes.php')->direct(Request::uri(), Request::method());




