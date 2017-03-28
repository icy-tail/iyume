<?php
namespace app\mobile\controller;

use \app\common\Controllers;
use \app\model\Data;

class Index extends Controllers
{
	public function index()
	{
		return '<font size="18px">:) 欢迎访问移动端</font>';
	}
	public function add()
	{
		// $data = new Data;
		// $data->udata = 'thinkphp';
		// $data->a = 'thinkphp@qq.com';
		// $data->save();
	}
	public function del()
	{
		$data = Data::get(466);
		$data->delete();
	}
	public function select()
	{
		// $datalist = Data::where('title','s')->select();
		// print_r($datalist);
		// $data = Data::get(['udata'=>'ac2900075']);
		// if(!$data){
		// 	return '数据不存在';
		// }else{
		// 	return $data;
		// }
	}
	public function update()
	{
		
	}
}
