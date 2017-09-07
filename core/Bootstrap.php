<?php 




use Src\Core\Database\QueryBuilder;
use Src\Core\Database\Connection;
use Src\Core\App;





//Associando a um conteiner da aplicação configurações gerais (Por enquanto possui configuracao de conexecao ao banco mysql)
App::bind('config', require 'config.php');

// Associando tambem uma instancia com a conexão (objeto querybuilder), que será utilizada para executar as queries
App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));