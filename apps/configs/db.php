<?php
$conFilePath = __DIR__ . DS . ENV . DS . 'db.php';
if (file_exists($cacheConFilePath)){
    $db = require_once $cacheConFilePath;
}else{
    $db = [];
}

return $db;