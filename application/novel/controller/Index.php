<?php
namespace app\novel\controller;

use \app\common\Controllers;
use \app\common\ToolsUtils;
use \app\model\Novel;

class Index extends Controllers
{
	public function index()
	{
		$novel_list = Novel::all();
		$this->view->engine->layout(true);
		$this->assign('novel_list',$novel_list);
		return $this->fetch('novel_list');
	}
	public function read($name, $page)
	{
		$lines = 100;
		$start = ($page - 1) * $lines + 1;
		$novel = Novel::get(['novelid' => $name]);
		if(!$novel){
			throw new \think\exception\HttpException(404, '资源不存在');
		}
		$file = NOVEL_PATH . $novel->fileurl;
		$concent = ToolsUtils::read_file_lines($file, $start, $start + $lines);
		// $concent = iconv('GBK','UTF-8//ignore', $concent);
		if(!$concent){
			$this->error('已完结');
		}
		$this->assign([
			'title' => $novel->name,
			'concent' => $concent,
			'name' => $name,
			'page' => $page
		]);
		$this->view->engine->layout(true);
		return $this->fetch('novel');
	}
}
