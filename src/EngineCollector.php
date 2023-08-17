<?php

namespace UUAI\Engine;


use Hyperf\Collection\Collection;
use Hyperf\Di\MetadataCollector;
use UUAI\Engine\Annotation\UUAIEngineApiRegister;
use UUPT\Contract\Exception\EngineException;

class EngineCollector extends MetadataCollector
{
    protected static array $container = [];

    /**
     * Constructs a route collector.
     */
    public static function addEngine($api, $class, UUAIEngineApiRegister $register)
    {
        $key = strtolower($register->getGroup() . $api);
        if (isset(static::$container[$key])) {
            throw new EngineException("引擎{$key}已经注册，请检查是否重复注册！");
        }
        static::$container[$key] = [
            'class' => $class,
            'name' => $register->getName(),
            'api' => $api,
            'desc' => $register->getDesc(),
            'group' => $register->getGroup(),
            'engine_id' => $register->getEngineId(),
        ];
    }

    /**
     * 获取所有数据
     * @return array
     */
    public static function getData()
    {
        return static::$container;
    }

    /**
     * 获取所有引擎列表
     * @return array
     */
    public static function getEngines()
    {
        $list = [];
        foreach (static::$container as $item){
            $list[$item['class']] ??= [
                'name'=>$item['name'],
                'class'=>$item['class'],
                'group'=>$item['group'],
                'desc'=>$item['desc'],
                'engine_name' => $item['engine_name'],
            ];
            $list[$item['class']]['apis'][] = $item['api'];
        }
        return array_values($list);
    }

    public static function getEngine($engine)
    {
        $class = self::getEngineClass($engine);
        if (!class_exists($class)) {
            throw new BusinessException(ErrorCode::ERROR_INTERNAL_UNSUPPORTED_ENGINE, '暂不支持该引擎-' . ucwords($engine));
        }
        return \Hyperf\Support\make($class);
    }

    public static function getEngineClass($api = '')
    {
        return static::$container[strtolower($api)]['class'] ?? throw new EngineException("引擎不存在！");
    }
}
