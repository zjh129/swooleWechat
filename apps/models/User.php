<?php
namespace App\Model;

class User extends \App\Component\BaseModel
{
    public $primary = 'userId';
    /**
     * 表名
     * @var string
     */
    public $table = 'user';
}