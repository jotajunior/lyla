<?php

namespace Core;

class Controller {

	public $route;

	public $template = 'layout/default';
	
	public function __construct($request = NULL, $response = NULL)
	{
		//
	}

	public function before()
	{
		$this->template = new View($this->template);
	}

	public function after()
	{
	}
	
	public function __destruct()
	{
		//
	}

}