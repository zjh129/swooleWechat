<?php
namespace App\Component;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class RabbitMQ
 * @package Swoole\Component
 */
class RabbitMQ
{
    //配置项
    private $host;
    private $port;
    private $user;
    private $pass;
    private $vhost;
    protected $exchangeName = 'swoole';
    protected $queueName = 'swoole:queue';

    const READ_LINE_NUMBER = 0;
    const READ_LENGTH = 1;
    const READ_DATA = 2;

    /**
     * @var  \PhpAmqpLib\Connection\AMQPStreamConnection
     */
    protected $connection;
    /**
     * @var \PhpAmqpLib\Channel\AMQPChannel
     */
    protected $channel;
    protected $queue;

    public $config;

    public static $prefix = "autoinc_key:";

    function __construct($config)
    {
        $this->config = $config;

        //设置rabbitmq配置值
        $this->host = $this->config['host'];
        $this->port = $this->config['port'];
        $this->user = $this->config['user'];
        $this->pass = $this->config['pass'];
        $this->vhost = $this->config['vhost'];

        $this->connect();
    }

    /**
     * 连接rabbitmq消息队列
     * @return bool
     */
    function connect()
    {
        try
        {
            if ($this->connection)
            {
                unset($this->connection);
            }
            $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->pass, $this->vhost);
        }
        catch (\Exception $e)
        {
            \Swoole::$php->log->error(__CLASS__ . " Swoole RabbitMQ Exception" . $e->getMessage());
            return false;
        }
    }

    /**
     * 关闭连接
     */
    function close()
    {
        $this->channel->close();
        $this->connection->close();
    }

    /**
     * 设置交换机名称
     * @param string $exchangeName
     */
    function setExchangeName($exchangeName = '')
    {
        $exchangeName && $this->exchangeName = $exchangeName;
    }

    /**
     * 设置队列名称
     * @param string $queueName
     */
    function setQueueName($queueName = '')
    {
        $queueName && $this->queueName = $queueName;
    }

    /**
     * 设置频道
     */
    function initChannel()
    {
        if (!$this->channel){
            //通道
            $this->channel = $this->connection->channel();
            $this->channel->queue_declare($this->queueName, false, true, false, false);
            $this->channel->exchange_declare($this->exchangeName, 'direct', false, true, false);
            $this->channel->queue_bind($this->queueName, $this->exchangeName);
        }
    }

    /**
     * 获取队列数据
     * @return mixed
     */
    function pop()
    {
        while (1) {
            try {
                $this->connect();
                $this->initChannel();
                $message = $this->channel->basic_get($this->queueName);
                if ($message) {
                    $this->channel->basic_ack($message->delivery_info['delivery_tag']);
                    $result = $message->body;
                }else{
                    throw new Exception('Empty Queue Data');
                }
            }catch (\Exception $e)
            {
                //\Swoole::$php->log->error(__CLASS__ . " [" . posix_getpid() . "] Swoole RabbitMQ[{$this->config['host']}:{$this->config['port']}] Exception(Msg=" . $e->getMessage() . ", Code=" . $e->getCode() . ")");
                sleep(1);
                continue;
            }
            return $result;
        }
        //不可能到这里
        return false;
    }

    /**
     * 插入队列数据
     * @param $data
     * @return bool
     */
    function push($data)
    {
        while (1) {
            try {
                $this->connect();
                $this->initChannel();
                $message = new AMQPMessage($data, ['content_type'=>'text/plain', 'devlivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
                $this->channel->basic_publish($message, $this->exchangeName);
            }catch (\Exception $e)
            {
                //\Swoole::$php->log->error(__CLASS__ . " [" . posix_getpid() . "] Swoole RabbitMQ[{$this->config['host']}:{$this->config['port']}] Exception(Msg=" . $e->getMessage() . ", Code=" . $e->getCode() . ")");
                continue;
            }
            return true;
        }
        //不可能到这里
        return false;
    }

    function __call($method, $args = array())
    {
        $reConnect = false;
        while (1)
        {
            try
            {
                $this->initChannel();
                $result = call_user_func_array(array($this->channel, $method), $args);
            }
            catch (\Exception $e)
            {
                //已重连过，仍然报错
                if ($reConnect)
                {
                    throw $e;
                }

                \Swoole::$php->log->error(__CLASS__ . " [" . posix_getpid() . "] Swoole RabbitMQ[{$this->config['host']}:{$this->config['port']}] Exception(Msg=" . $e->getMessage() . ", Code=" . $e->getCode() . "), RabbitMQ->{$method}, Params=" . var_export($args, 1));
                if ($this->connection)
                {
                    $this->close();
                }

                $this->connect();

                $reConnect = true;
                continue;
            }
            return $result;
        }
        //不可能到这里
        return false;
    }
}
