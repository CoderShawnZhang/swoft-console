<?php
/**
 * 注解处理器
 */
namespace SwoftRewrite\Console\Annotation\Parser;

use SwoftRewrite\Annotation\Annotation\Parser\Parser;
use SwoftRewrite\Annotation\Annotation\Mapping\AnnotationParser;
use SwoftRewrite\Bean\Annotation\Mapping\Bean;
use SwoftRewrite\Console\Annotation\Mapping\Command;
use SwoftRewrite\Console\CommandRegister;
use SwoftRewrite\Stdlib\Helper\Str;

/**
 * Class CommandParser
 *
 * @since 2.0
 *
 * @AnnotationParser(Command::class)
 */
class CommandParser extends Parser
{
    /**
     * @param int $type
     * @param Command $annotation Annotation object
     * @return array
     * @throws \Exception
     */
    public function parse(int $type, $annotation)
    {
        if($type !== self::TYPE_CLASS){
            throw new \Exception('`@Command` must be defined on class!');
        }

        $class = $this->className; //SwoftRewrite\Http\Server\Command\HttpServerCommand
        $group = $annotation->getName() ?: Str::getClassName($class,'Command'); //‌http
        CommandRegister::addGroup($class,$group,[
            'group' => $group,
            'desc' => $annotation->getDesc(),
            'alias' => $annotation->getAlias(),
            'aliases' => $annotation->getAliases(),
            'enabled' => $annotation->isEnabled(),
            'coroutine'=>$annotation->isCoroutine(),
            'idAliases' => $annotation->getIdAliases(),
            'defaultCommand' => $annotation->getDefaultCommand()
        ]);
        return [$class,$class,Bean::SINGLETON,''];
    }
}