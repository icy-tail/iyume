<?php
namespace app\news2\controller;

use \app\common\Controllers;
use \think\Db;
use \app\model\Data;
use \think\Log;

class Index extends Controllers
{
	public function index()
	{
		$this->view->engine->layout(false);
		return $this->fetch('news2');
	}
	public function getdata($draw = 0, $start = 0, $length = 0){
		$relist = Db::query('select * from s_data order by id desc limit ?,?', [$start, $length]);
		$datalist = array();
		foreach ($relist as $key => $he) {
			$list = array();
			array_push($list, $he['a']);
			array_push($list, $he['time']);
			array_push($list, $he['acid']);
			array_push($datalist, $list);
		}

		$RecordsTotal = Data::count();
		$RecordsFiltered = $RecordsTotal;

		$Data = array("draw"=>$draw,
			"recordsTotal"=>$RecordsTotal,
			"recordsFiltered"=>$RecordsFiltered,
			"data"=>$datalist);
		return json($Data);
	}
}
