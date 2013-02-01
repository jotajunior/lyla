<?php

namespace Core;

class Response {

	public static $instance;
	
	public $body;
	
	public static function instance()
	{
		if(! self::$instance)
		{
			self::$instance = new \Core\Response;
		}
		
		return self::$instance;
	}
	
	public function add($view)
	{
		if($view)
		{
			$this->body[] = $view;
		}
	}
	
	public function body($view = NULL)
	{
		if($view)
		{
			$this->body = $view;
		}
		
		if(is_array($this->body))
		{
			$this->body = implode('', $this->body);
		}
		
		return $this->body;
	}

}