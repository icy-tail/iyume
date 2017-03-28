<?php
namespace app\api\controller;

use \app\model\Data;
use \think\Loader;
use \app\common\ToolsUtils;
use \app\common\Controllers;

class Snatch extends Controllers
{
	public function index()
	{
		Loader::import('phpQuery', EXTEND_PATH);
		\phpQuery::newDocumentFile("http://www.acfun.cn/v/list110/index.htm");
		$alables = pq("div .l .mainer .item .title");
		$datas = 0;
		ToolsUtils::createAcDb();
		foreach ($alables as $lable) {
			$alable = pq($lable);
			$aid = substr($alable,12,9);
			$href = "http://www.acfun.cn/a/".$aid;
			$a = $alable->text();
			$data = Data::get(['acid' => $aid]);
			if(!$data){
				\phpQuery::newDocumentFile($href);
				$title_1 = pq("#title_1");
				$title = pq($title_1)->find(".txt-title-view_1")->text();
				$fbsj = pq($title_1)->find(".time")->text();
				$content = pq("#area-player");

				$data = new Data;
				$data->data([
					'acid' => $aid,
					'a' => $a,
					'time' => date("Y-m-d H:i:s",time()),
					'head_title' => $title,
					'release_time' => $fbsj,
					'source' => 'acfun',
					'href' => 'http://www.acfun.cn/a/' . $aid
					]);
				$this->save_ac_file($aid, $content);
				$data->save();
				$datas++;
			}
		}
		ToolsUtils::log("成功抓取".$datas."条新数据");
		return "成功抓取".$datas."条新数据";
	}
	public function repairdata($acs){
		$aclist = explode(',' , $acs);
		$i = 0;
		ToolsUtils::createAcDb();
		foreach ($aclist as $a) {
			$href = "http://www.acfun.cn/a/".$a;
			\phpQuery::newDocumentFile($href);
			$title_1 = pq("#title_1");
			$title = pq($title_1)->find(".txt-title-view_1")->text();
			$fbsj = pq($title_1)->find(".time")->text();
			$content = pq("#area-player");
			$this->save_ac_data($a, $title, $content);

			$data = Data::get(['acid' => $a]);
			if(!$data){
				$data = new Data;
			}
			$data->data([
				'acid' => $a,
				'a' => $title,
				'time' => date("Y-m-d H:i:s",time()),
				'head_title' => $title,
				'release_time' => $fbsj,
				'source' => 'acfun',
				'href' => 'http://www.acfun.cn/a/' . $a
				]);
			$data->save();
			$i++;
		}
		$log = '成功修复'. $i .'条数据';
		ToolsUtils::log($log);
		return $log;
	}

	public function repair(){
		$this->view->engine->layout(true);
		return $this->fetch('repair');
	}

	function save_ac_file($a, $content){
		ToolsUtils::savefile(AC_FILE_PATH, $a.".txt", $content);
	}

	function save_ac_data($a, $title, $content){
		$ac = new \app\model\AcData;
		$sql = "insert into s_ac_data (ac, title, contents) values ('".$a."', '".$title."', '".$content."')";

		$db_name = $ac->connection['database'];
		$db_type = $ac->connection['type'];
		$dsn = $db_type.':'.$db_name;
		$dbh = new \PDO($dsn, null, null);

		$dbh->exec($sql);
	}
}
