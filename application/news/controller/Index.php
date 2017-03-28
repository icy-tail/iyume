<?php
namespace app\news\controller;

use \app\common\Controllers;
use \think\Db;

class Index extends Controllers
{
	public function index($pages = 10)
	{
		$_REQUEST['page'] = input('page');
		$query = Db::table('s_data')->order('id desc')->paginate($pages, true);
		$this->assign('list', $query);

		$count = Db::table('s_data')->field('ceiling(count(id)/'.$pages.') as count')->select();
		$this->assign('count', $count[0]['count']);
		$this->view->engine->layout(true);
		return $this->fetch('news');
	}
}
