<?php
// 事件定义文件
return [
	'bind' => [
	
	],
	
	'listen' => [
		
		'AddSite' => [
			'addon\wechat\event\AddSiteReplay',// 添加默认关注回复
		],
	],
	
	'subscribe' => [
	],
];