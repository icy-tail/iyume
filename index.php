<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');
define('EXTEND_PATH', __DIR__ . '/extension/');				// 扩展文件路径
define('UPLOAD_PATH', __DIR__ . '/static/upload/');			// 文件上传绝对路径
define('UPLOAD_PATH_RELATIVE', '/mobile/static/upload/');	// 文件上传相对路径
define('AC_FILE_PATH', '/static/file/a/htm/');				// 抓取文件相对路径
define('ERROR_PATH', __DIR__ . '/static/error/');			// 错误文件路径
define('ROOT', __DIR__);									// 根目录
define('NOVEL_PATH', __DIR__ . '/static/file/novel/');		// 文档目录
define('SQL_PATH', __DIR__ . '/static/file/sql/');			// sql文件目录
// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';
