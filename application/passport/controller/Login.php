<?php
namespace app\passport\controller;

use \app\common\Controllers;
use \think\Session;

class Login extends Controllers
{
	public function index()
	{
		if(Session::get('userinfo')){
			$this->success('已登录', 'http://iyume.cn');
		} else {
			return $this->fetch();
		};
	}
}
