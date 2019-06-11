<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/8
 * Time: 下午3:05
 */
namespace SwoftRewrite\Console\Annotation\Parser;

use SwoftRewrite\Annotation\Annotation\Parser\Parser;
use SwoftRewrite\Annotation\Annotation\Mapping\AnnotationParser;
use SwoftRewrite\Console\Annotation\Mapping\Command;

/**
 * Class CommandParser
 *
 * @since 2.0
 *
 * @AnnotationParser(Command::class)
 */
class CommandParser extends Parser
{
    public function parse(int $type, $annotationObject)
    {

       return [1,2,3];
    }
}