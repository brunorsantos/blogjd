<?php 

$router->addRoute('GET','api/user','Api\UserController@index');
$router->addRoute('POST','api/user','Api\UserController@store');
$router->addRoute('DELETE','api/user/{id}','Api\UserController@remove');
$router->addRoute('GET','api/user/{id}','Api\UserController@get');
$router->addRoute('PUT','api/user/{id}','Api\UserController@update');

// $router->define([
// 	'api/teste' => 'controllers/index.php',
// 	'about' => 'controllers/about.php',
// 	'about-culture' => 'controllers/about-culture.php',
// 	'contact' => 'controllers/contact.php'

// ]);