<?php 

namespace Src\Core;

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
		 

		$routesForMethod = array_filter($this->routes, function ($route) use ($method) {
			return $route['method'] == $method;
		});


		foreach ($routesForMethod as $route) {
		//	dd($route);
			//if ($uri == $route['url']) {
			if (fnmatch($route['url'],$uri)) {
				$arrayRoute = explode('/',$route['url']);
				$arrayUri = explode('/',$uri);	
				//dd($arrayUri);
				$arrayParam = array_filter($arrayUri, function($value, $key) use($arrayRoute) {
						    return $arrayRoute[$key] == '*';
						}, ARRAY_FILTER_USE_BOTH);
				//dd($arrayParam);

				$arrController = explode('@',$route['action']);

            	return $this->callAction($arrController[0],$arrController[1],$arrayParam);


			}
		}

		throw new \Exception('Rota nao definida');
		
	}

	protected function callAction($controller, $action, $param = [])
    {
       
		$controller = "Src\\Controllers\\{$controller}";
        $controller = new $controller;
        //dd($controller);

        if (! method_exists($controller, $action)) {
            throw new \Exception(
                "{$controller} nao possui metodo {$action} ."
            );
        }
     //   $teste = 'tesdad';
        return $controller->$action(...$param);
    }

	public function addRoute($method, $url, $action)
	{
		//dd($);

		$url = preg_replace("/\{[^\}]*\}/", '*', $url);

		//$teste = preg_match_all("/\{([^\}]*)\}/", $url, $matches);
		//dd($matches);

		$this->routes[] = ['method' => $method,
					 'url' => $url,
					 'action' => $action];
	}
}