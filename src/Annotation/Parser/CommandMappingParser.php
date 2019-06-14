<?php
/**
 * 解析命令方法
 */

namespace SwoftRewrite\Console\Annotation\Parser;


use SwoftRewrite\Annotation\Annotation\Parser\Parser;
use SwoftRewrite\Annotation\Annotation\Mapping\AnnotationParser;
use SwoftRewrite\Console\Annotation\Mapping\CommandMapping;
use SwoftRewrite\Console\CommandRegister;

/**
 *
 * @AnnotationParser(CommandMapping::class)
 */
class CommandMappingParser extends Parser
{
    /**
     * @param int $type
     * @param CommandMapping $annotation
     * @return array
     */
    public function parse(int $type, $annotation)
    {
        if ($type !== self::TYPE_METHOD) {
            throw new AnnotationException('`@CommandMapping` must be defined on class method!');
        }

        $method = $this->methodName;

        // add route info for controller action
        CommandRegister::addRoute($this->className, $method, [
            'command' => $annotation->getName() ?: $method,
            'method'  => $method,
            'alias'   => $annotation->getAlias(),
            'aliases' => $annotation->getAliases(),
            'desc'    => $annotation->getDesc(),
            'usage'   => $annotation->getUsage(),
            // 'example' => $annotation->getExample(),
        ]);

        return [];
    }
}