<?php
return array(
	//'配置项'=>'配置值'
	'URL_CASE_INSENSITIVE' => true,//URL不区分大小写
	'TMPL_L_DELIM'=>'{[', //修改左定界符
	'TMPL_R_DELIM'=>']}', //修改右定界符
	// 'DB_PREFIX'=>'fli_',  //设置表前缀
	// 'DB_DSN'=>'mysql://root:@localhost:3306/Stock',//使用DSN方式配置数据库信息
	'DB_TYPE' => 'mysql', // 数据库类型
	'DB_HOST' => 'localhost', // 服务器地址
	'DB_NAME' => 'Stock', // 数据库名
	'DB_USER' => 'root', // 用户名
	'DB_PWD' => '', // 密码
	'DB_PORT' => 3306, // 端口
	'DB_PREFIX' => 'fli_', // 数据库表前缀
	'DB_CHARSET'=> 'utf8', // 字符集
	'SHOW_PAGE_TRACE'=>true,//开启页面Trace
	'TMPL_PARSE_STRING'=>array(           //添加自己的模板变量规则
		'__CSS__'=>__ROOT__.'/Public/CSS',
		'__IMG__'=>__ROOT__.'/Public/IMG',
		'__JS__'=>__ROOT__.'/Public/JS',
		'__ASSETS__'=>__ROOT__.'/assets',
	),
);
?>