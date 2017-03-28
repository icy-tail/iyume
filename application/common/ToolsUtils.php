<?php
namespace app\common;
use \think\File;

class ToolsUtils{
	public static function savefile($xdpath, $filename, $content){
		$file_ab_path = $_SERVER['DOCUMENT_ROOT'].$xdpath;
		if (!is_dir($file_ab_path)){
			mkdir($file_ab_path);
		}
		$of = fopen($file_ab_path.$filename,"w");	//创建并以读写打开
		if($of){
			fwrite($of,$content);	//把执行文件的结果写入txt文件
		}
		fclose($of);
		return true;
	}
	public static function read_file_lines($filename, $startLine = 1, $endLine=50, $method='rn'){
		$content = array();
		$count = $endLine - $startLine;  
		// 判断php版本（因为要用到SplFileObject，PHP>=5.1.0）
		if(version_compare(PHP_VERSION, '5.1.0', '>=')){
			$fp = new File($filename, $method);
			// 转到第N行, seek方法参数从0开始计数
			$fp->seek($startLine-1);
			for($i = 0; $i <= $count; ++$i) {
				// current()获取当前行内容
				$content[] = $fp->current();
				// 下一行
				$fp->next();
			}
		}else{	// PHP<5.1
			$fp = fopen($filename, $method);
			if(!$fp) return 'error:can not read file';
			// 跳过前$startLine行
			for ($i = 1; $i < $startLine; ++$i) {
				fgets($fp);
			}
			for($i; $i <= $endLine; ++$i){
				// 读取文件行内容
				$content[] = fgets($fp);
			}
			fclose($fp);
		}
		$text = '';
	    // array_filter过滤：false,null,''
		foreach (array_filter($content) as $key => $value) {
			$text .= '<p>'.$value.'</p>';
		}
		return $text;
	}
	public static function log($log = ""){
		$logfile = $_SERVER['DOCUMENT_ROOT']."/log/".date("Y-m-d",time()).".txt";
		$logpath = dirname($logfile);
		if(!is_dir($logpath)){
			mkdir($logpath);
		}
		$of = fopen($logfile,"a");
		if($of){
			fputs($of, date("Y-m-d H:i:s", time())." ".$log."\n");
		}
		fclose($of);
		return true;
	}
	// 预定义的字符转换为HTML实体
	public static function to_html($str){
		return htmlspecialchars($str, ENT_QUOTES);
	}
	public static function to_sql($str){
		return mysql_real_escape_string($str);
	}
	public function toJson($datalist){	//转换为JSON对象，返回JSON Object，参数list
		return json_encode($datalist, JSON_UNESCAPED_UNICODE);
	}
	public static function createAcDb(){
		$ac = new \app\model\AcData;
		$db_name = $ac->connection['database'];
		$db_type = $ac->connection['type'];
		// 创建数据库文件目录
		$dbpath = dirname($db_name);
		if(!is_dir($dbpath)){
			mkdir($dbpath);
		}
		// 创建数据库文件,文件内容为空
		if (!file_exists($db_name)) {
			$fp = fopen($db_name, "w+");
			fclose($fp);
			// 打开数据库文件
			$dsn = $db_type.':'.$db_name;
			$dbh = new \PDO($dsn, null, null);
			// 产生数据表结构
			$sql = file_get_contents(SQL_PATH.'main.sql');
			$dbh->exec($sql);
		}
	}
}