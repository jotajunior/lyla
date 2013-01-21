<?php

namespace Core;

class Controller {

	public $request;
	public $response;

	public $route;

	public $template = 'layout/default';
	
	public function __construct($request = NULL, $response = NULL)
	{
		$this->request = $request;
		$this->response = $response;
	}

	public function before()
	{
		if(! $this->request->is_ajax()) {
			$this->template = new View($this->template);
		}
	}

	public function after()
	{
		return Response::instance()->body($this->template);
	}
	
	public function __destruct()
	{
		//
	}

}