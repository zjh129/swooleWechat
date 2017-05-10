<?php
$conFilePath = __DIR__ . DS . ENV . DS . 'cache.php';
if (file_exists($cacheConFilePath)){
    $cache = require_once $cacheConFilePath;
}else{
    $cache = [];
}

return $cache;
