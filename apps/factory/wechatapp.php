<?php
global $php;
$configs = $php->config['wechat'];
if (empty($configs[\Swoole::$php->factory_key]))
{
    throw new Swoole\Exception\Factory("wechat->".\Swoole::$php->factory_key." is not found.");
}
$config = $configs[$php->factory_key];

$wechatapp = new \EasyWeChat\Foundation\Application($config);
return $wechatapp;