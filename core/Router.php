<?php 

namespace Src\Core;


 /**
 * Classe responsavel por fazer o rotamento das Url, eviando para o controller corresponde
 *
 */
class Router
{
	protected $routes = [];


	 /**
     * Cria uma instancia roteadora executando codigo existente dentro de arquivo com rotas
     * que carregará o atributo do objeto com todas as rotas da aplicação
     *
     * @param  String $file  Arquivo de rotas
     * @return object
     */
	public static function load($file)
	{
		$router = new static;

		require $file;

		return $router;
	}
	
	// public function define($routes)
	// {
	// 	$this->routes = $routes;
	// }

	 /**
     * Encaminha para codigo do controller
     *
     */

	public function direct($uri,$method)
	{
		 
		// Filtra apenas rotas com metodo definido igual ao enviado na request
		$routesForMethod = array_filter($this->routes, function ($route) use ($method) {
			return $route['method'] == $method;
		});


		foreach ($routesForMethod as $route) {
			// Faz uma comparacao com 'wildcards' com a url vinda da request, e array de rotas salvas na aplicacao 
			if (fnmatch($route['url'],$uri)) {
				$arrayRoute = explode('/',$route['url']);
				$arrayUri = explode('/',$uri);	
				// Em trechos em que sao definidos os coringas com *, são identificados parametros a serem passados para o controller
				$arrayParam = array_filter($arrayUri, function($value, $key) use($arrayRoute) {
						    return $arrayRoute[$key] == '*';
						}, ARRAY_FILTER_USE_BOTH);


				$arrController = explode('@',$route['action']);

            	return $this->callAction($arrController[0],$arrController[1],$arrayParam);


			}
		}

		throw new \Exception('Rota nao definida');
		
	}

	 /**
     * Metodo que expande parametros e chama execução do código do metodo no controller
     *
     */

	protected function callAction($controller, $action, $param = [])
    {
       
		$controller = "Src\\Controllers\\{$controller}";
        $controller = new $controller;


        if (! method_exists($controller, $action)) {
            throw new \Exception(
                "{$controller} nao possui metodo {$action} ."
            );
        }

        return $controller->$action(...$param);
    }

	 /**
     * Medodo utilizado para criar rotas, chamadas no arquivo routes.php
     * Armazenando em atributo array do objeto a rota, metodo e ação 
     * Onde for encontrado o padrão {id} na URL da rota, é substituido por * via expressao regular.
     * Podendo assim comparar esses trechos como coringas na busca da url da request
     *
     * @param  String $file  Arquivo de rotas
     * @return object     
     */

	public function addRoute($method, $url, $action)
	{
		$url = preg_replace("/\{[^\}]*\}/", '*', $url);

		$this->routes[] = ['method' => $method,
					 'url' => $url,
					 'action' => $action];
	}
}