<?php

namespace UUAI\Engine;


use Hyperf\Di\MetadataCollector;
use UUPT\Contract\Exception\EngineException;

class EngineCollector extends MetadataCollector
{
    protected static array $container = [];

    /**
     * Constructs a route collector.
     */
    public static function addEngine($api, $class, $group)
    {
        static::$container[$group . $api] = $class;
    }

    /**
     * Returns the collected route data, as provided by the data generator.
     * @return array
     */
    public function getData()
    {
        return $this->list();
    }

    public static function getEngine($api = '')
    {
        return static::$container[$api] ?? throw new EngineException("引擎不存在！");
    }
}
