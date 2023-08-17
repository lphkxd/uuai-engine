<?php
declare(strict_types=1);

namespace UUAI\Engine\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AnnotationInterface;
use UUAI\Engine\EngineCollector;

/**
 * @Annotation
 * @Target({"CLASS"})
 */
#[Attribute(Attribute::TARGET_CLASS)]
class UUAIEngineApiRegister implements AnnotationInterface
{
    /**
     * @param string $name 引擎名字
     * @param string $api 单个API
     * @param array $apis 支持API
     * @param string $desc 引擎介绍
     * @param string $group 分组
     * @param int $engine_name
     */
    public function __construct(
        private string $name = '',
        private string $api = '',
        private array  $apis = [],
        private string $desc = '',
        private string $group = '',
        private string $engine_name = "",
    )
    {
    }

    /**
     * @return string
     */
    public function getApi(): string
    {
        return $this->api;
    }

    /**
     * @param string $api
     */
    public function setApi(string $api): void
    {
        $this->api = $api;
    }

    /**
     * @return array
     */
    public function getApis(): array
    {
        return $this->apis;
    }

    /**
     * @param array $apis
     */
    public function setApis(array $apis): void
    {
        $this->apis = $apis;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * @param string $desc
     */
    public function setDesc(string $desc): void
    {
        $this->desc = $desc;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function collectClass(string $class): void
    {
        if (!empty($this->api)) {
            EngineCollector::addEngine($this->api, $class, $this);
        }
        foreach ($this->apis as $api) {
            EngineCollector::addEngine($api, $class, $this);
        }
    }

    public function collectMethod(string $className, ?string $target): void
    {
    }

    /**
     * Collect the annotation metadata to a container that you want.
     */
    public function collectProperty(string $className, ?string $target): void
    {
    }

    /**
     * @return int|string
     */
    public function getEngineName(): int|string
    {
        return $this->engine_name;
    }

    /**
     * @param int|string $engine_name
     */
    public function setEngineName(int|string $engine_name): void
    {
        $this->engine_name = $engine_name;
    }



}
