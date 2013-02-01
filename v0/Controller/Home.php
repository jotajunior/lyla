<?php

namespace Controller;

use \Core\Request;
use \Core\Response;


class Home extends \Core\Controller
{

	public function index()
	{
		$view = new \View\Home\Index;
		$this->template->content = $view;
	}

}