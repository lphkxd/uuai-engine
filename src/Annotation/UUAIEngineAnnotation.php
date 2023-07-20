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
class UUAIEngineAnnotation implements AnnotationInterface
{
    /**
     * @param string $name  引擎名字
     * @param array  $apis  支持API
     * @param string $group 分组
     */
    public function __construct(
        private string $name = '',
        private array  $apis = [],
        private string $group = '',
    )
    {
    }

    public function collectClass(string $class): void
    {
        foreach ($this->apis as $api) {
            EngineCollector::addEngine($api, $class, $this->group);
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
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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


    public function collectMethod(string $className, ?string $target): void
    {
    }

    /**
     * Collect the annotation metadata to a container that you want.
     */
    public function collectProperty(string $className, ?string $target): void
    {
    }
}
