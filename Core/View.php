<?php

namespace Core;

class View
{

	private $fileName;
	
	public $data;
	
	public function __construct($viewName = '')
	{
		if(! $viewName)
		{
			$viewName = strtolower(str_replace('View\\', '', get_class($this)));
		}
		$viewName = str_replace('\\',\DIRECTORY_SEPARATOR, $viewName);
		$this->fileName = \APP.'templates/'.$viewName.'.php';
		if(! file_exists($this->fileName))
		{
			throw new \Exception('View '.$viewName.' not found!');
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
		
		if(is_array($this->data))
		{
			foreach($this->data as $index => $view):
				if($view instanceof View)
				{
					$this->data[$index] = $view->render();
				}
			endforeach;
			
			extract($this->data);
		}
		
		include $this->fileName;
		
		$view = ob_get_contents();
		
		ob_end_clean();
		
		if($auto)
		{
			echo $view;
			return;
		}
		
		return $view;
	}
	
	public function __toString()
	{
		return $this->render();
	}
}
