<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/14
 * Time: 上午11:25
 */

namespace SwoftRewrite\Console\Annotation\Mapping;

use SwoftRewrite\Stdlib\Helper\Str;

/**
 * The annotation of command mapping
 * @since 2.0
 *
 * @Annotation
 * @Target({"METHOD"})
 * @Attributes(
 *     @Attribute("name", type="string"),
 *     @Attribute("alias", type="string")
 * )
 */
final class CommandMapping
{
    /**
     * Command name
     *
     * @var string
     */
    private $name = '';

    /**
     * Command name alias(es), multi by ',' split.
     *
     * @var string
     */
    private $alias = '';

    /**
     * The command description message text
     *
     * @var string
     */
    private $desc = '';

    /**
     * Custom usage help information
     *
     * @var string
     */
    private $usage = '{fullCommand} [arguments ...] [options ...]';

    /**
     * Mapping constructor.
     *
     * @param array $values
     */
    public function __construct(array $values)
    {
        if (isset($values['value'])) {
            $this->name = (string)$values['value'];
        } elseif (isset($values['name'])) {
            $this->name = (string)$values['name'];
        }

        if (isset($values['alias'])) {
            $this->alias = trim((string)$values['alias']);
        }

        if (isset($values['desc'])) {
            $this->desc = trim((string)$values['desc']);
        }

        if (isset($values['usage'])) {
            $this->usage = (string)$values['usage'];
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
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @return string[]
     */
    public function getAliases(): array
    {
        return $this->alias ? Str::explode($this->alias) : [];
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * @return string
     */
    public function getUsage(): string
    {
        return $this->usage;
    }
}