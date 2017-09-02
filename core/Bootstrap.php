<?php 

$config = require 'config.php';

require 'core/database/Connection.php';

require 'core/database/QueryBuilder.php';

require 'core/Router.php';

require 'helpers.php';


// $a = Connection::make();
return new QueryBuilder(
	Connection::make($config['database'])
);