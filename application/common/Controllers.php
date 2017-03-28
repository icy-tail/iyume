<?php
namespace app\common;

use \think\Controller;
use \app\common\ToolsUtils;
use \think\Request;
use \app\model\Accessip;
use \app\model\Navigation;

class Controllers extends Controller
{
	public function _initialize(){
		// 记录访问日志并持久化为文本
		$request = Request::instance();
		$log = $request->ip().' '.$request->method().' '.$request->type().' '.var_export($request->isAjax(), true).' '.$request->url(true);
		ToolsUtils::log($log);

		$ip = $request->ip();
		$ipinfo = file_get_contents("http://api.map.baidu.com/location/ip?ak=wHzg92psvAHAzEpiLALalcuwPmDsCfqE&coor=bd09ll&ip=".$ip);
		$ipinfo = json_decode($ipinfo);
		if(!$ipinfo->status){
			$info = $ipinfo->content;
			$accessip = Accessip::get(['ip' => $ip]);
			if($accessip){
				$accessip->address = $info->address;
				$accessip->x = $info->point->x;
				$accessip->y = $info->point->y;
				$accessip->lastdate = date("Y-m-d H:i:s",time());
				$accessip->count = $accessip->count + 1;
			}else{
				$accessip = new Accessip;
				$accessip->data([
					'ip' => $ip,
					'address' => $info->address,
					'x' => $info->point->x,
					'y' => $info->point->y,
					'count' => 1,
					'lastdate' => date("Y-m-d H:i:s",time())
					]);
			}
			$accessip->save();
		}
		// 渲染导航栏
		$navigation = Navigation::all(function($query){
			$query->where('display', 1)->order('sort', 'asc');
		});
		$this->assign([
			'navlist' => $navigation
		]);
	}
}
