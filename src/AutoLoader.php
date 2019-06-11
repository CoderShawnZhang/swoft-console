<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/8
 * Time: 上午11:58
 */

namespace SwoftRewrite\Console;


use SwoftRewrite\Bean\DemoT;
use SwoftRewrite\Framework\SwoftComponent;

class AutoLoader extends SwoftComponent
{
    public function enable()
    {
        return true;
    }

    public function getPrefixDirs()
    {
        return [
            __NAMESPACE__ => __DIR__
        ];
    }

    public function beans()
    {
        return [
            'DemoT' => [
                'class' => DemoT::class,
                'version' => '1.0.0'
            ]
        ];
    }
}