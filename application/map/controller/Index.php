<?php
namespace app\map\controller;

use \app\common\Controllers;

class Index extends Controllers
{
	public function index()
	{
		$this->view->engine->layout(true);
		return $this->fetch('map');
	}
}
