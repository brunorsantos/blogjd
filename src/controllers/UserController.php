<?php 



namespace Src\Controllers;

use Src\Core\App;
use Src\User\User;


class UserController 
{
	public function index($par = null,$par2 = null)
	{
		$users = User::all();
		//dd($users);
	}

}




