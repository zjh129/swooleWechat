<?php
global $php;

$config = $php->config['qiniu'][$php->factory_key];
if (empty($config) or empty($config['host'])) {
    throw new Exception("require qiniu[$php->factory_key] config.");
}

$auth = new \Qiniu\Auth($config['accessKey'], $config['secretKey']);
// 生成上传Token
$token = $auth->uploadToken($config['bucket']);
// 初始化 UploadManager 对象并进行文件的上传
$uploadZone = new \Qiniu\Zone($config['upHost'], $config['upHostBackup']);
$uploadConfig = new \Qiniu\Config($uploadZone);
$uploadMgr = new \Qiniu\Storage\UploadManager($uploadConfig);

return $uploadMgr;
// 上传到七牛后保存的文件名
//$key = substr($this->fullName, 1);
// 调用 UploadManager 的 putFile 方法进行文件的上传
//list($ret, $err) = $uploadMgr->put($token, $key, file_get_contents($file["tmp_name"]));
