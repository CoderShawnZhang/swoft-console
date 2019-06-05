<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/5
 * Time: 上午11:32
 */

namespace SwoftRewrite\Console;


use SwoftRewrite\Console\Contract\ConsoleInterface;

class Application implements ConsoleInterface
{
    public function run()
    {
        Console::writef('');
    }
}