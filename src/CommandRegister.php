<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/14
 * Time: 上午10:11
 */

namespace SwoftRewrite\Console;

use SwoftRewrite\Console\Helper\DocBlock;
use SwoftRewrite\Console\Router\Router;
use SwoftRewrite\Framework\Swoft;
use SwoftRewrite\Stdlib\Helper\Str;

final class CommandRegister
{
    private static $commands = [];

    public static function register(Router $router)
    {
        $maxLen = 12;
        $docOpts = [
            'allow' => ['example']
        ];
        $defInfo = [
            'example'     => '',
            'description' => 'No description message',
        ];
        foreach(self::$commands as $class => $mapping){
            $group = $mapping['group'];
            $refInfo = Swoft::getReflection($class);
            $mhdInfo = $refInfo['methods'] ?? [];
            $grpOpts = $mapping['options'] ?? [];

            foreach($mapping['commands'] as $method => $route){
                $cmdDesc = $route['desc'];
                $command = $route['command'];

                $idLen = strlen($group . $command);
                if($idLen > $maxLen){
                    $maxLen = $idLen;
                }
                
                $cmdExam = '';
                if(!empty($mhdInfo[$method]['comments'])){
                    $tagInfo = DocBlock::getTags($mhdInfo[$method]['comments'],$docOpts,$defInfo);
                    $cmdDesc = $cmdDesc ?: Str::firstLine($tagInfo['description']);
                    $cmdExam = $tagInfo['example'];
                }

                $route['group'] = $group;
                $route['desc'] = ucfirst($cmdDesc);
                $route['examplr'] = $cmdExam;
                $route['options'] = self::mergeOptions($grpOpts,$route['options']);

                $route['enabled'] = $mapping['enabled'];
                $route['coroutine'] = $mapping['coroutine'];

                $router->map($group,$command,[$class,$method],$route);
                $names[] = $command;
            }

        }
    }

    public static function addGroup(string $class,string $group,array $info)
    {
        $info['group'] = $group;
        self::$commands[$class] = $info;
    }

    /**
     * 扫描到方法会自动加入 路由命令数组
     * @param string $class
     * @param string $method
     * @param array $route
     */
    public static function addRoute(string $class,string $method,array $route)
    {
        $route['options'] = [];
        $route['arguments'] = [];
        self::$commands[$class]['commands'][$method] = $route;
    }

    /**
     * @param array $grpOptions
     * @param array $cmdOptions
     * @return array
     */
    private static function mergeOptions(array $grpOptions, array $cmdOptions): array
    {
        if ($grpOptions) {
            return array_merge($grpOptions, $cmdOptions);
        }

        return $cmdOptions;
    }
}