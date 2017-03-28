<?php
namespace app\api\controller;

use \think\Request;
use \think\Db;

class Access
{
	public function index()
	{
		return json('参数错误');
	}
	public function getinfo()
	{
		$result = Db::name('accessip')->select();
		return json($result);
	}
}
