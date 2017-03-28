<?php
namespace app\miss\controller;

use \app\common\Controllers;

class Index extends Controllers
{
	public function notfound()
	{
		throw new \think\exception\HttpException(404, '页面不存在');
	}
}
