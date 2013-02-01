<?php

namespace Core;

class Request {

	public $route;
	
	public $query;
	
	public function route()
	{
		$uri = $_SERVER['REQUEST_URI'];
		//remove APP URI
		$uri = str_replace(APP_URI, '', parse_url($uri, PHP_URL_PATH));
		$uri = explode('/', $uri);
		$this->route['controller'] = isset($uri[0]) && $uri[0] ? $uri[0] : 'Home';
		$this->route['action'] = isset($uri[1]) && $uri[1] ? $uri[1] : 'index';
		$this->route['id'] = isset($uri[2]) && $uri[2] ? $uri[2] : '';
		
		return $this->route;
	}
	
	public function query()
	{
            $queryString = isset($_SERVER['QUERY_STRING']) ?
                $_SERVER['QUERY_STRING'] :
                '';
		parse_str($queryString, $query);
		$this->query = $query;
		return $this->query;
	}
	
	public function param($index)
	{
		return isset($this->route[$index]) ? $this->route[$index] : NULL;
	}
	
	public function process()
	{
		$this->route();
		
		$this->query();
	
		$controllerName = '\\Controller\\'.ucfirst($this->route['controller']);
		$actionName = $this->route['action'];

		$controller = new $controllerName($this, Response::instance());

		if(! method_exists($controller, $actionName)){
			throw new Exception('Request Error 404: Page not found!');
		}

		$controller->before();
		$controller->$actionName();
		$controller->after();
		
		return $this;
	}
	
	public function response()
	{
		return Response::instance();
	}

}