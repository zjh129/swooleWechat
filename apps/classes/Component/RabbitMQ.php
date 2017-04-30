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
            \Swoole::$php->log->error(__CLASS__ . " Swoole RabbitMQ Exception" . var_export($e, 1));
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
        //通道
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queueName, false, true, false, false);
        $this->channel->exchange_declare($this->exchangeName, 'direct', false, true, false);
        $this->channel->queue_bind($this->queueName, $this->exchangeName);
    }

    /**
     * 获取队列数据
     * @return mixed
     */
    function pop()
    {
        $ret = $this->channel->basic_get($this->queueName);
        return $ret;
    }

    /**
     * 插入队列数据
     * @param $data
     * @return bool
     */
    function push($data)
    {
        $message = new AMQPMessage($data, ['content_type'=>'text/plain', 'devlivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
        $this->channel->basic_publish($message, $this->exchangeName);
        return true;
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

                \Swoole::$php->log->error(__CLASS__ . " [" . posix_getpid() . "] Swoole RabbitMQ[{$this->config['host']}:{$this->config['port']}]
                 Exception(Msg=" . $e->getMessage() . ", Code=" . $e->getCode() . "), RabbitMQ->{$method}, Params=" . var_export($args, 1));
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

    static function write($fp, $content)
    {
        $length = strlen($content);
        for ($written = 0; $written < $length; $written += $n)
        {
            if ($length - $written >= 8192)
            {
                $n = fwrite($fp, substr($content, 8192));
            }
            else
            {
                $n = fwrite($fp, substr($content, $written));
            }
            //写文件失败了
            if (empty($n))
            {
                break;
            }
        }
        return $written;
    }

    /**
     * @param $file
     * @param $dstRedisServer
     * @param int $seek
     * @return bool
     */
    static function syncFromAof($file, $dstRedisServer, $seek = 0)
    {
        $fp = fopen($file, 'r');
        if (!$fp)
        {
            return false;
        }
        //偏移
        if ($seek > 0)
        {
            fseek($fp, $seek);
        }

        //目标Redis服务器
        $dstRedis = stream_socket_client($dstRedisServer, $errno, $errstr, 10);
        if (!$dstRedis)
        {
            return false;
        }

        $n_bytes = $seek;
        $n_lines = 0;
        $n_success = 0;
        $_send = '';
        $patten = "#^\\*(\d+)\r\n$#";

        readfile:
        while(!feof($fp))
        {
            $line = fgets($fp, 8192);
            if ($line === false)
            {
                echo "line empty\n";
                break;
            }
            $n_lines++;
            $r = preg_match($patten, $line);
            if ($r)
            {
                if ($_send)
                {
                    if (self::write($dstRedis, $_send) === false)
                    {
                        die("写入Redis失败. $_send");
                    }
                    $n_bytes += strlen($_send);
                    //清理数据
                    if (fread($dstRedis, 8192) == false)
                    {
                        echo "读取Redis失败. $_send\n";
                        for($i = 0; $i < 10; $i++)
                        {
                            $dstRedis = stream_socket_client($dstRedisServer, $errno, $errstr, 10);
                            if (!$dstRedis)
                            {
                                echo "连接到Redis($dstRedisServer)失败, 1秒后重试.\n";
                                sleep(1);
                            }
                        }
                        if (!$dstRedis)
                        {
                            echo "连接到Redis($dstRedisServer)失败\n";
                            return false;
                        }
                        $_send = $line;
                        continue;
                    }

                    $n_success ++;
                    if ($n_success % 10000 == 0)
                    {
                        $seek = ftell($fp);
                        echo "KEY: $n_success, LINE: $n_lines, BYTE: {$n_bytes}, SEEK: {$seek}. 完成\n";
                    }
                }
                $_send = $line;
            }
            else
            {
                $_send .= $line;
            }
        }

        wait:
        //等待100ms后继续读
        sleep(2);
        $seek = ftell($fp);
        echo "read eof, seek={$seek}\n";
        //关闭文件
        fclose($fp);
        $fp = fopen($file, 'r');
        if (!$fp)
        {
            exit("打开文件失败，seek=$seek\n");
        }
        if (fseek($fp, $seek) < 0)
        {
            exit("feek($seek)失败\n");
        }
        goto readfile;
    }
}
