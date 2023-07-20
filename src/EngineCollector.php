<?php

namespace UUAI\Engine;


use Hyperf\Di\MetadataCollector;
use UUAI\Engine\Annotation\UUAIEngineRegister;
use UUPT\Contract\Exception\EngineException;

class EngineCollector extends MetadataCollector
{
    protected static array $container = [];

    /**
     * Constructs a route collector.
     */
    public static function addEngine($api, $class, UUAIEngineRegister $register)
    {
        static::$container[$register->getGroup() . $api] = [
            'class' => $class,
            'name' => $register->getName(),
            'desc' => $register->getDesc(),
            'group' => $register->getGroup(),
        ];
    }

    /**
     * Returns the collected route data, as provided by the data generator.
     * @return array
     */
    public function getData()
    {
        return $this->list();
    }

    public static function getEngineClass($api = '')
    {
        return static::$container[$api]['class'] ?? throw new EngineException("引擎不存在！");
    }
}
