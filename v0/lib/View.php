<?php

namespace View;

class View
{

	public $fileName;
	
	public function __construct($viewName)
	{
		$this->fileName = 'templates/'.$viewName.'.php';
		
		if(! file_exists($this->fileName))
		{
			throw new Exception('View '.$viewName.' not found!');
		}
	}
	
	public function __get($index)
	{
		return $this->data[$index];
	}
	
	public function __set($index, $value)
	{
		$this->data[$index] = $value;
	}
	
	public function render($auto = true)
	{
		ob_start();
		
		foreach($this->data as $view):
			if($view instanceof View)
			{
				$view->render();
			}
		endforeach;
		
		extract($this->data);
		
		include $this->filename;
		
		$view = ob_get_contents();
		
		ob_end_clean();
		
		if($auto)
		{
			echo $view;
			return;
		}
		
		return $view;
	}
}
