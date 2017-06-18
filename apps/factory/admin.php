<?php
global $php;
$admin = new Swoole\Auth($php->config['admin']);
return $admin;