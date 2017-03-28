<?php
namespace app\video\controller;

use \app\common\Controllers;
use \app\model\Video;
use \think\Db;

class Index extends Controllers
{
	public function index($pages = 10)
	{
		$_REQUEST['page'] = input('page');
		$query = Db::table('s_video')->order('id desc')->paginate($pages, true);
		$this->assign('vlist', $query);

		$count = Db::table('s_video')->field('ceiling(count(id)/'.$pages.') as count')->select();
		$this->assign('count', $count[0]['count']);
		$this->view->engine->layout(true);
		return $this->fetch('video_list');
	}
	public function play($id)
	{
		$video = Video::get($id);
		$this->assign([
				'video' => $video
			]);
		$this->view->engine->layout(true);
		return $this->fetch('video_play');
	}
}
