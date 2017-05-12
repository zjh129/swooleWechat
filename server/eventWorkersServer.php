<?php
//echo json_encode(['type'=>'Hello','data'=>['name'=>'zhaojianhui','sex'=>'男']]);exit();
//跑任务的脚本
/**
 * 配置文件：apps/configs/event.php
 * 事件列表：apps/events/*.php
 * 处理代码：apps/classes/Handler/*.php
 */
//载入初始化文件
require_once __DIR__ . '/initServer.php';
//执行脚本
Swoole::$php->event->runWorker(2);
