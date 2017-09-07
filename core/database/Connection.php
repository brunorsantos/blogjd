<?php 

namespace Src\Core\Database;

use PDO;
use PDOException;

class Connection
{

	 /**
     * Metodo estatico para que faz a conexao com o banco
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
	
	public static function make($config)			
	{
		try {

				return new PDO( $config['connection']. ';dbname='. $config['name'],
								$config['username'],
								$config['password'],
								$config['options']);
			} catch ( PDOException $e) {	
				die($e->getMessage());
			}	
	}
}