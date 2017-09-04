<?php 

namespace Src\Core;

use Src\Core\App;

abstract class Model
{
	protected $table;
	protected $primaryKey;
	protected $id;

	public static function all()
	{
		return App::get('database')->selectAll((new static)->table);
	}

	public static function find($id)
	{
		$object = (new static);
		$data = App::get('database')->selectOne($object->table, $object->primaryKey,$id);
		$object->id = $id;
		return $object;

	}

	public function delete()
	{
		App::get('database')->delete($this->table, $this->primaryKey, $this->id);
	}

	public static function insert($parameters)
	{
		$object = (new static);
		App::get('database')->insert($object->table, $parameters);
	}

	public function update($parameters)
	{
		App::get('database')->update($this->table, $this->primaryKey, $this->id,$parameters);
	}

}