<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/5
 * Time: 下午3:44
 */

namespace SwoftRewrite\Console\Helper\Swoole;


class SwooleServer implements SwooleInterface
{
    private $server;

    public function __construct()
    {
        $this->server = new \swoole_server("0.0.0.0", 9501);
        $this->server->on('start',[$this,'starta']);
    }

    public function starta()
    {
        printf("\033[0;35m 服1务已经启动. \033[0m \n");
    }
    public function start()
    {

        //监听连接进入事件
        $this->server->on('connect', function ($serv, $fd) {
            echo "Client: Connect.\n";
        });

        //监听数据接收事件
        $this->server->on('receive', function ($serv, $fd, $from_id, $data) {
            $serv->send($fd, "Server: " . $data);
        });

//监听连接关闭事件
        $this->server->on('close', function ($serv, $fd) {
            echo "Client: Close.\n";
        });
        $this->server->start();
    }
}