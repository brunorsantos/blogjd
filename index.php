<?php

require 'vendor/autoload.php';
require 'core/Bootstrap.php';



use Src\Core\Router;
use Src\Core\Request;

$uri = trim(
	parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'
	);
$method = $_SERVER['REQUEST_METHOD'];


// Criando suporte a receber parametros a partir de um requisicao com metodo PUT
if ('PUT' == $method) {
    parse_str(file_get_contents("php://input"),$post_vars);
    Request::setParameters($post_vars);
}
if ('POST' == $method) {
	Request::setParameters($_POST);
}




//Metodo de classe construida a partir de arquivo de rotas, chama execucao de controller

Router::load('routes.php')->direct(Request::uri(), Request::method());




