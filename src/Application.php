<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/5
 * Time: 上午11:32
 */

namespace SwoftRewrite\Console;


use SwoftRewrite\Console\Contract\ConsoleInterface;
use SwoftRewrite\Bean\Annotation\Mapping\Bean;

/**
 * @Bean("cliApp")
 */
class Application implements ConsoleInterface
{
    private $version = '1.0.99';

    public function run()
    {
        Console::writef('');
    }
}