<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
        'page' => '\d+'
    ],
    // '__miss__'  => 'miss/index/notfound',
    '__domain__'=>[
        'm'      => 'mobile',
        'api'    => 'api',
        'passport' => 'passport'
    ],
    'a/:ac' => 'a/index/index',
    'news/:page' => 'news/index/index',
    'novel/:name/:page' => 'novel/index/read',
    'videos/:page' => 'video/index/index',
    'video/:id' => 'video/index/play'
];
