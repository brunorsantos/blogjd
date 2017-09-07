<?php 

namespace Src\Core;

use Src\Core\App;
	 /**
     * Classe a ser extendida pelas models das aplicação, com funcionalidades abstraidas para acesso aos dados
     * 
     *
     */
abstract class Model
{
	protected $table;
	protected $primaryKey;
	protected $id;

	 /**
     * Obtem todos os registros da table a ser associada a model
     * atraves do atributo $table da classe 
     *
     * @return object
     */

	public static function all()
	{
		return App::get('database')->selectAll((new static)->table);
	}

	public static function find($id)
	{
		$object = (new static);
		$data = App::get('database')->selectOne($object->table, $object->primaryKey,$id);
		if (empty($data)) {
			return null;
		}
		$object->id = $id;
		return $data;

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