<?php 



namespace Src\Controllers\Api;

use Src\Core\App;
use Src\User\User;
use Src\Core\Request;


class UserController 
{
	public function index()
	{

		$users = User::all();
		dd($users);
	}

	public function remove($id)
	{
		$user = User::find($id);
		$user->delete();
		dd($user);
	}

	public function store()
	{

		$parameter = ['name' => Request::getParameters()['name'] ];

		User::insert($parameter);
		dd('foi');
	}

	public function get($id)
	{

		$user = User::find($id);
		dd($user);
	}

	public function update($id)
	{

		$user = User::find($id);
		$parameter = ['name' => Request::getParameters()['name'],
					];

		$user->update($parameter);
		dd('foi');
	}


}




