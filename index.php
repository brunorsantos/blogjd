<?php


$query = require 'core/Bootstrap.php';


//require 'routes.php';

//dd($_SERVER);

$uri = trim($_SERVER['REQUEST_URI'],'/');
$method = $_SERVER['REQUEST_METHOD'];


$adas = require Router::load('routes.php')->direct($uri,$method);




