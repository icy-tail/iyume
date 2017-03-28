<?php

namespace app\index\controller;



use \app\common\Controllers;

use \think\Request;



class Index extends Controllers

{

	public function index()

	{

		return $this->fetch();

	}

	public function upload()

	{

		$file = request()->file('image');

		$info = $file->move(UPLOAD_PATH,true,false);

		if($info){

			return '<img src="'.UPLOAD_PATH_RELATIVE.$info->getSaveName().'" />';

		}else{

			echo $file->getError();

		}

	}

	public function open()

	{

		$request = Request::instance();

		return '<img src="'.UPLOAD_PATH_RELATIVE.substr($request->path(),21).'" />';

	}

}

