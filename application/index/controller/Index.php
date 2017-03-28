<?php
namespace app\index\controller;

use \app\common\Controllers;
use \app\model\Navigation;

class Index extends Controllers
{
	public function index()
	{
		// 渲染导航栏
		$navigation = Navigation::all(function($query){
			$query->where('display', 1)->order('sort', 'asc');
		});
		$this->assign([
			'navlist' => $navigation
		]);
		return $this->fetch();
	}
}
