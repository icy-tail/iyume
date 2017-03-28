<?php
namespace app\a\controller;

use \app\common\Controllers;
use \app\model\Data;

class Index extends Controllers
{
	public function index($ac)
	{
		$data = Data::get(['acid' => $ac]);
		if($data){
			$concent = $this->get4local($ac);
			$this->assign([
				'data' => $data,
				'concent' => $concent
				]);
			return $this->fetch('a');
		}else{
			$this->notfound();
		}
	}
	function notfound(){
		throw new \think\exception\HttpException(404, '资源丢失');
	}
	// 通过读取本地文件获取文章正文
	function get4local($ac){
		$concent = @file_get_contents($_SERVER['DOCUMENT_ROOT'].AC_FILE_PATH.$ac.".txt") or $this->notfound();
		return $concent;
	}
	// 通过读取sqlite数据库获取文章正文
	function get4sqlite($ac){
		$concent = AcData::get(['ac' => $ac]);
		$concent = $concent != null ? $concent->conent : $this->notfound();
		return $concent;
	}
}
