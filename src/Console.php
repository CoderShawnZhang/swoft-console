<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/1
 * Time: 下午4:20
 */
namespace SwoftRewrite\Console;

class Console
{
    public function test()
    {
        echo "run Console";
    }

    public static function writef(string $formt, ...$args)
    {
        return self::write([111,222]);
    }

    public static function write($message,$nl = true,$quit = false,array $options = [])
    {
//        printf("\033[0;30m Hello World. \033[0m \n");
//        printf("\033[1;30m Hello World. \033[0m \n");
//        printf("\033[0;34m Hello World. \033[0m \n");
//        printf("\033[1;34m Hello World. \033[0m \n");
//        printf("\033[0;32m Hello World. \033[0m \n");
//        printf("\033[1;32m Hello World. \033[0m \n");
//        printf("\033[0;36m Hello World. \033[0m \n");
//        printf("\033[1;36m Hello World. \033[0m \n");
//        printf("\033[0;31m Hello World. \033[0m \n");
//        printf("\033[1;31m Hello World. \033[0m \n");
//        printf("\033[0;35m Hello World. \033[0m \n");
//        printf("\033[1;35m Hello World. \033[0m \n");
//        printf("\033[0;33m Hello World. \033[0m \n");
//        printf("\033[1;33m Hello World. \033[0m \n");
//        printf("\033[0;37m Hello World. \033[0m \n");
//        printf("\033[1;37m Hello World. \033[0m \n");
        $server = new \swoole_server("0.0.0.0", 9501);

        $server->on('start',function(){
            printf("\033[0;35m 服务已经启动. \033[0m \n");
        });
        //监听连接进入事件
        $server->on('connect', function ($serv, $fd) {
            echo "Client: Connect.\n";
        });

//监听数据接收事件
        $server->on('receive', function ($serv, $fd, $from_id, $data) {
            $serv->send($fd, "Server: " . $data);
        });

//监听连接关闭事件
        $server->on('close', function ($serv, $fd) {
            echo "Client: Close.\n";
        });
        $server->start();
    }
}