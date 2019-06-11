<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/8
 * Time: 下午3:04
 */
namespace SwoftRewrite\Console\Annotation\Mapping;

use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class Command
 *
 * @Annotation
 *
 * @since 2.0
 */
final class Command
{
    private $name = '';
    private $scope = 'singleton';
    private $alias = '';

    public function __construct(array $values)
    {
        if (isset($values['value'])) {
            $this->name = $values['value'];
        }
        if (isset($values['name'])) {
            $this->name = $values['name'];
        }
        if (isset($values['scope'])) {
            $this->scope = $values['scope'];
        }
        if (isset($values['alias'])) {
            $this->alias = $values['alias'];
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }
}