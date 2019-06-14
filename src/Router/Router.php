<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/14
 * Time: 上午8:43
 */
namespace SwoftRewrite\Console\Router;

use SwoftRewrite\Bean\Annotation\Mapping\Bean;

/**
 * @Bean("cliRouter")
 */
class Router
{
    public $a = 9;
    private $routes = [];
    private $delimiter = ':';
    private $commandAliases = [];
    private $groupAliases = [];


    public function map(string $group,string $command,$handler,array $config = [])
    {
        $cmdID = $this->buildCommandID($group,$command);

        if($aliases = $config['aliases'] ?? []){
            $this->setCommandAliases($command,$aliases);
        }
        $config['handler'] = $handler;
        $this->routes[$cmdID] = $config;
    }
    
    public function match(...$params): array
    {
        $delimiter = $this->delimiter;//命令里的冒号 ：
        $inputCmd = trim($params[0],"$delimiter");
        $noSepChar = strpos($inputCmd,$delimiter) === false;


        $nameList = explode($delimiter,$inputCmd,2);
        if(count($nameList) === 2){
            [$group,$command] = $nameList;
            $command = $this->resolveCommandAlias($command);
        } else {
            $command = '';
            $group = $nameList[0];
        }

        $group = $this->resolveGroupAlias($group);
        //build command ID
        $commandID = $this->buildCommandID($group,$command);

        if(isset($this->routes[$commandID])){
            $info = $this->routes[$commandID];
            // append some info
            $info['cmdId'] = $commandID;
            return [1, $info];
        }
    }

    /**
     * command ID = group + : + command
     *
     * @param string $group
     * @param string $command
     *
     * @return string
     */
    public function buildCommandID(string $group, string $command): string
    {
        if ($group) {
            return sprintf('%s%s%s', $group, $this->delimiter, $command);
        }

        return $command;
    }

    /**
     * @param string $command
     * @param array  $aliases
     */
    public function setCommandAliases(string $command, array $aliases): void
    {
        foreach ($aliases as $alias) {
            $this->setCommandAlias($command, $alias);
        }
    }

    /**
     * @param string $command
     * @param string $alias
     */
    public function setCommandAlias(string $command, string $alias): void
    {
        if ($command && $alias) {
            $this->commandAliases[$alias] = $command;
        }
    }

    public function resolveCommandAlias(string $name)
    {
        return $this->commandAliases[$name] ?? $name;
    }

    public function resolveGroupAlias(string $name)
    {
        return $this->groupAliases[$name] ?? $name;
    }
}