<?php
//初始化文件
define('DEBUG', 'on');
define('DS', DIRECTORY_SEPARATOR);
define('WEBPATH', __DIR__ . DS . '..');

//使用composer扩展
require_once WEBPATH . '/vendor/autoload.php';
//载入swoole frameworkZ框架配置
require_once WEBPATH . '/vendor/matyhtf/swoole_framework/libs/lib_config.php';
