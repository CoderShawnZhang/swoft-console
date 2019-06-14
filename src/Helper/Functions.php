<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/1
 * Time: 下午5:11
 */

use SwoftRewrite\Framework\Swoft;
use SwoftRewrite\Console\Input\Input;

if(!function_exists('input')){
    function input()
    {
        return Swoft::getSingleton(Input::class);
    }
}