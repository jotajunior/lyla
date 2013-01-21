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
			$viewName = strtolower(
				str_replace(array('View\\', '\\'), array('', '/'), get_class($this))
			);
		}
		
		$this->fileName = 'templates/'.$viewName.'.php';
		
		if(! file_exists($this->fileName))
		{
			throw new \Exception('View '.$viewName.' not found!');
		}
	}
	
	public function __get($index)
	{
		return isset($this->data[$index]) ? $this->data[$index] : NULL;
	}
	
	public function __set($index, $value)
	{
		$this->data[$index] = $value;
	}
	
	public function render()
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
		
		$content = ob_get_contents();
		
		ob_end_clean();
		
		return $content;
	}
	
	public function __toString()
	{
		return $this->render();
	}
}
