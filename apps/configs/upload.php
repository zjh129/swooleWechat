<?php
$conFilePath = __DIR__ . DS . ENV . DS . 'upload.php';
if (file_exists($conFilePath)){
    $upload = require_once $conFilePath;
}else{
    $upload = [];
}

return $upload;