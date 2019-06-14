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
use SwoftRewrite\Stdlib\Helper\Str;

/**
 * Class Command
 *
 * @Annotation
 * @Target("CLASS")
 * @Attributes(
 *     @Attribute("name",type="string"),
 *     @Attribute("alias",type="string")
 * )
 */
final class Command
{
    private $name = '';
    private $scope = 'singleton';
    private $alias = '';
    private $coroutine = true;
    private $desc = '';
    private $idAliases = [];
    private $defaultComman = '';
    private $enabled = true;

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
        if(isset($values['enabled'])){
            $this->enabled = (bool)$values['enabled'];
        }
        if(isset($values['coroutine'])){
            $this->coroutine = (bool)$values['coroutine'];
        }
        if(isset($values['desc'])){
            $this->desc = trim((string)$values['desc']);
        }
        if(isset($values['idAliases'])){
            $this->idAliases = (array)$values['idAliases'];
        }
        if(isset($values['defaultComamnd'])) {
            $this->defaultComman = trim($values['defaultComamnd']);
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

    public function isCoroutine(): bool
    {
        return $this->coroutine;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function getAliases(): array
    {
        return $this->alias ? Str::explode($this->alias) : [];
    }

    public function getDefaultCommand()
    {
        return $this->defaultComman;
    }

    public function getIdAliases()
    {
        return $this->idAliases;
    }
}