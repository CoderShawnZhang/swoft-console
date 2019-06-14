<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/14
 * Time: 下午5:12
 */

namespace SwoftRewrite\Console\Input;


abstract class AbstractInput
{
    protected $sOpts = [];
    protected $lOpts = [];

    public function getSOpts()
    {
        return $this->sOpts;
    }

    public function getLOpts()
    {
        return $this->lOpts;
    }

    public function getLongOpt(string $name,$default = null)
    {
        return $this->lOpts[$name] ?? $default;
    }
}