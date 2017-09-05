<?php 



namespace Src\Controllers\Api;

use Src\Controllers\Api\ResponseController;
use Src\Core\App;
use Src\Core\Request;
use Src\Post;


class PostController extends ResponseController
{
	public function index()
	{

		$posts = Post::all();
		return $this->respond($posts);
	}

	public function remove($id)
	{
		$post = Post::find($id);
		if (empty($post)) {
			return $this->respondNotFound('Post não encontrado');
		}

		$post->delete();
		return $this->respond();
	}

	public function store()
	{

		$parameter = ['title' => Request::getParameters()['title'],
					  'body' =>	Request::getParameters()['body'],
					  'path' => Request::getParameters()['path'],
					  'id_user' => Request::getParameters()['id_user'] ];

		Post::insert($parameter);
		return $this->respond();
	}

	public function get($id)
	{

		$post = Post::find($id);
		if (empty($post)) {
			return $this->respondNotFound('Post não encontrado');
		}
		//dd($post);
		return $this->respond($post);
	}

	public function update($id)
	{

		$post = Post::find($id);
		if (empty($post)) {
			return $this->respondNotFound('Post não encontrado');
		}
		$parameter = ['title' => Request::getParameters()['title'],
					  'body' =>	Request::getParameters()['body'],
					  'path' => Request::getParameters()['path'],
					  'id_user' => Request::getParameters()['id_user'] ];

		$post->update($parameter);
		return $this->respond();
	}


}




