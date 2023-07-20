<?php
declare(strict_types=1);

namespace UUAI\Engine;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__
                    ],
                    'collectors' => [
                        EngineCollector::class
                    ]
                ],
            ],
        ];
    }
}
