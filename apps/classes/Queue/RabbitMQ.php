<?php
namespace App\Queue;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class RabbitMQ
 * @package App\Queue
 */
class RabbitMQ implements \Swoole\IFace\Queue
{
    //配置项
    private $host;
    private $port;
    private $user;
    private $pass;
    private $vhost;

    protected $rabbitFactoryKey;
    protected $exchangeName = 'swoole';
    protected $queueName = 'swoole:queue';

    /**
     * @var  \PhpAmqpLib\Connection\AMQPStreamConnection
     */
    protected $connection;
    /**
     * @var \PhpAmqpLib\Channel\AMQPChannel
     */
    protected $channel;
    protected $queue;



    public function __construct($config)
    {
        if (empty($config['id'])) {
            $config['id'] = 'master';
        }
        $this->rabbitFactoryKey = $config['id'];
        if (!empty($config['key'])) {
            $this->queueName = $config['key'];
        }
    }

    /**
     * 创建连接
     */
    private function connect()
    {
        //创建连接
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->pass, $this->vhost);
        //通道
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queueName, false, true, false, false);
        $this->channel->exchange_declare($this->exchangeName, 'direct', false, true, false);
        $this->channel->queue_bind($this->queueName, $this->exchangeName);
    }

    /**
     * 关闭连接
     */
    private function close()
    {
        $this->channel->close();
        $this->connection->close();
    }

    /**
     * 出队
     */
    public function pop()
    {
        $ret = $this->channel->basic_get($this->queueName);
        if ($ret) {
            return unserialize($ret);
        } else {
            return false;
        }
    }

    /**
     * 入队
     * @param $data
     */
    public function push($data)
    {
        $sendData = serialize($data);
        $message = new AMQPMessage($sendData, ['content_type'=>'text/plain', 'devlivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
        $this->channel->basic_publish($message, $this->exchangeName);
        return true;
    }
}
