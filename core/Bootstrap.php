<?php 




use Src\Core\Database\QueryBuilder;
use Src\Core\Database\Connection;
use Src\Core\App;
use Src\Core\Request;




// require 'core/database/Connection.php';

// require 'core/database/QueryBuilder.php';

// require 'core/Router.php';

// require 'helpers.php';
App::bind('config', require 'config.php');

// $a = Connection::make();
App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));