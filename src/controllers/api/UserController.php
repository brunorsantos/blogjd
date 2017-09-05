<?php 



namespace Src\Controllers\Api;

use Src\Controllers\Api\ResponseController;
use Src\Core\App;
use Src\Core\Request;
use Src\User;


class UserController extends ResponseController
{
	public function index()
	{

		$users = User::all();
		return $this->respond($users);
	}

	public function remove($id)
	{
		$user = User::find($id);
		if (empty($user)) {
			return $this->respondNotFound('Usuario não encontrado');
		}

		$user->delete();
		return $this->respond();
	}

	public function store()
	{

		$parameter = ['name' => Request::getParameters()['name'] ];

		User::insert($parameter);
		return $this->respond();
	}

	public function get($id)
	{

		$user = User::find($id);
		if (empty($user)) {
			return $this->respondNotFound('Usuario não encontrado');
		}
		return $this->respond($user);
	}

	public function update($id)
	{

		$user = User::find($id);
		if (empty($user)) {
			return $this->respondNotFound('Usuario não encontrado');
		}
		$parameter = ['name' => Request::getParameters()['name'],
					];

		$user->update($parameter);
		return $this->respond();
	}


}




