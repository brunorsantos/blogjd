<?php 	

namespace Src\Core\Database;

use PDO;
use PDOException;

class QueryBuilder
{

	protected $pdo;

	 /**
     * Classe construtora que depende de uma instancia de conexao com o banco
     *
     * @param  PDO  $pdo Instancia de conexao com banco
     * @return void
     */

	function __construct(PDO $pdo)	
	{
		$this->pdo = $pdo;	
	}

	 /**
     * Select em todas colunas de todos os registros de uma determinada table
     *
     * @param  String $table  
     * @return object
     */

	public function selectAll($table)		
	{
		$statement = $this->pdo->prepare('select * from ' . $table);

		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_CLASS);
	}

	 /**
     * Select em todas colunas de um determinado registro de uma table table atraves de sua primary key
     *
     * @param  String $table  Tabela a ser realizado o select
  	 * @param  String $idName  Nome da coluna de primary key 
   	 * @param  String $idValue Valor a ser comparado na primary key 
     * @return object
     */

	public function selectOne($table,$idName, $idValue)		
	{

		$statement = $this->pdo->prepare('select * from ' . $table . ' where ' . $idName . ' = ' . $idValue);


		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_CLASS);

		if (!empty($rows)){
			return $rows[0];
		}

		return null;

		return $statement->fetchAll(PDO::FETCH_CLASS)[0];
	}

	 /**
     * Insert em uma determinada table 
     *
     * @param  String $table  Tabela a ser realizado o select
  	 * @param  Array $parameters Array com valores a serem inseridos 
     * @return void
     */

	public function insert($table, $parameters)
	{
		$sql = sprintf(
			'insert into %s (%s) values (%s)',
			$table,
			implode(',', array_keys($parameters)),
			':'. implode(', :', array_keys($parameters))
		);
		try{

			$statement = $this->pdo->prepare($sql);

			$statement->execute($parameters);

		}catch (Exception $e){

			die($e->getMessage());	

		}
	}

	 /**
     * Update em uma determinada table 
     *
     * @param  String $table  Tabela a ser realizado o select
     * @param  String $idName  
     * @param  String $idValue  
  	 * @param  Array $parameters Array com valores a serem inseridos 
     * @return void
     */

	public function update($table, $idName, $idValue, $parameters)
	{

		$arraySet = array_map(function ($value)
		{
			return $value . ' = :' .$value;
		},array_keys($parameters));

		$valueSet = implode(' , ',$arraySet);

		$sql = sprintf(
			'update %s set %s where %s = :%s',
			$table,
			$valueSet,
			$idName,
			$idName			
		);
		try{	

			$statement = $this->pdo->prepare($sql);
			$parameters[$idName] =  $idValue ;

			$statement->execute($parameters);


		}catch (Exception $e){

			die($e->getMessage());	

		}
	}

	 /**
     * Delete em uma determinada table 
     *
     * @param  String $table  Tabela a ser realizado o select
     * @param  String $idName  
     * @param  String $idValue  
     * @return void
     */

	public function delete($table, $idName, $idValue)
	{
		$sql = sprintf(
			'delete from %s where %s = :%s',
			$table,
			$idName,
			$idName
		);
		try{

			$statement = $this->pdo->prepare($sql);

			$parameters = [':'.$idName => $idValue ];

			$statement->execute($parameters);
			return true;


		}catch (\Exception $e){

			die($e->getMessage());	

		}

	}
}