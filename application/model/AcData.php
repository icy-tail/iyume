<?php
namespace app\model;

use think\Model;

class AcData extends Model {
	public $connection = [
        // 数据库类型
        'type'        => 'sqlite',
        // 数据库名
        'database'       => 'static/db/ac.db',
        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
        'prefix'      => 's_',
    ];
}