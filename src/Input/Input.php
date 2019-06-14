<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/13
 * Time: 下午5:43
 */
namespace SwoftRewrite\Console\Input;

use SwoftRewrite\Bean\Annotation\Mapping\Bean;

/**
 * @Bean("Input")
 */
class Input extends AbstractInput
{
    private $command;

    public function __construct()
    {
        $argv = isset($_SERVER['argv']) ? $_SERVER['argv'] : [];
        $this->setCommand(isset($argv[1]) ? $argv[1] : '');
    }

    public function setCommand($command)
    {
        $this->command = $command;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function getSameOpt(array $names,$default = null)
    {
        return $this->sameOpt($names,$default);
    }

    public function sameOpt(array $names,$default = null)
    {
        foreach($names as $name){
            if($this->hasSOpt($name)){
                return $this->getOpt($name);
            }
        }
        return $default;
    }

    public function hasSOpt(string $name)
    {
        return isset($this->sOpts[$name]);
    }

    public function getOpt(string $name,$default = null)
    {
        if(isset($name{1})){
            return $this->lOpt($name,$default);
        }

        return $this->sOpts($name,$default);
    }

    public function lOpt(string $name,$default = null)
    {
        return $this->lOpts[$name] ?? $default;
    }

    public function sOpt(string $name,$default = null)
    {
        return $this->sOpts[$name] ?? $default;
    }
}