<?php
namespace App\Model;
use Swoole;

class User extends Swoole\Model
{
    public $primary = 'userId';
    /**
     * 表名
     * @var string
     */
    public $table = 'user';
}