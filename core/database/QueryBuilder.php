<?php 	

namespace Src\Core\Database;

use PDO;
use PDOException;

class QueryBuilder
{

	protected $pdo;
	
	function __construct(PDO $pdo)	
	{
		$this->pdo = $pdo;	
	}

	public function selectAll($table)		
	{
		$statement = $this->pdo->prepare('select * from ' . $table);

		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_CLASS);
	}

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