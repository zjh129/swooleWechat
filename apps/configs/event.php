<?php
$conFilePath = __DIR__ . DS . ENV . DS . 'event.php';
if (file_exists($cacheConFilePath)){
    $event = require_once $cacheConFilePath;
}else{
    $event = [];
}

return $event;
