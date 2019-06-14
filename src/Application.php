<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/5
 * Time: 上午11:32
 */

namespace SwoftRewrite\Console;


use SwoftRewrite\Bean\BeanFactory;
use SwoftRewrite\Console\Contract\ConsoleInterface;
use SwoftRewrite\Bean\Annotation\Mapping\Bean;
use SwoftRewrite\Framework\Swoft;

/**
 * @Bean("cliApp")
 */
class Application implements ConsoleInterface
{
    private $version = '1.0.99';

    /**
     * @var Input\Input
     */
    protected $input;

    protected $autput;


    public function run()
    {
        try {
            Swoft::trigger(ConsoleEvent::RUN_BEFORE, $this);
            $this->prepare();

            $inputCommand = $this->input->getCommand();
            if (!$inputCommand) {
                $this->filterSpecialOption();
            } else {
                $this->doRun($inputCommand);
            }
            Swoft::trigger(ConsoleEvent::RUN_AFTER, $this, $inputCommand);
        } catch (\Throwable $e) {
            //输出异常
        }
    }

    public function doRun(string $inputCmd)
    {
        $t = 2342344;
        /* @var Router\Router $route*/
        $route = BeanFactory::getBean('cliRouter');

        $result = $route->match($inputCmd);
        if($result[0] == 2){

        }
        $info = $result[1];

        $this->bindOptionsAndArguments($info);

        //使用$result 派发
    }

    protected function prepare()
    {
        $this->input = \input();
    }

    public function filterSpecialOption()
    {
        if($this->input->getSameOpt(['V','version'],false)){
            //显示帮助信息
            return;
        }
        //显示帮助信息
    }

    protected function bindOptionsAndArguments(array $info)
    {
        if($opts = $info['options']){
            $sOpts = $this->input->getSOpts();
            $lOpts = $this->input->getLOpts();
            foreach($opts as $name => $opt){

            }
        }
    }
}