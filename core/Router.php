<?php 

/**
* 
*/
class Router
{
	protected $routes = [];

	public static function load($file)
	{
		$router = new static;


		require $file;

		//$router->addRoute('GET','api/teste','controllers/index.php');
		//dd($router);

		return $router;
	}
	
	public function define($routes)
	{
		$this->routes = $routes;
	}

	public function direct($uri,$method)
	{
		// dd($this->routes);

		$routesForMethod = array_filter($this->routes, function ($route) use ($method) {
			return $route['method'] == $method;
		});

		//dd($routesForMethod);
		foreach ($routesForMethod as $route) {
			//dd($route);
			if ($uri == $route['url']) {
				return $route['action'];
			}
		}
		// if (array_key_exists($uri, $routesForMethod)) {
		// 	return $this->routes[$uri];
		// }

		throw new Exception('Rota nao definida');
		
	}

	public function addRoute($method, $url, $action)
	{
		$this->routes[] = ['method' => $method,
					 'url' => $url,
					 'action' => $action];
	}
}