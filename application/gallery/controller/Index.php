<?php
namespace app\gallery\controller;

use \app\model\Image;
use \app\common\Controllers;

class Index extends Controllers
{
	public function index()
	{
		$list = Image::all(['relationcode'=>'gallery']);
		$this->assign('list', $list);
		$this->view->engine->layout(true);
		return $this->fetch('gallery');
	}
}
