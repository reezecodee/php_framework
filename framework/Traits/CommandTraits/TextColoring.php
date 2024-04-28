<?php

namespace Framework\Traits\CommandTraits;

trait TextColoring
{
    private $slash_commands = [
        'd' => [
            'drop:model YourModelName - menghapus sebuah model',
            'drop:controller YourControllerName - menghapus sebuah controller',
            'drop:migration YourMigrationName - menghapus sebuah migrasi'
        ],
        'm' => [
            'make:model Name - membuat sebuah model',
            'make:controller NameController - membuat sebuah controller',
            'make:migration NameTable - membuat sebuah controller',
        ],
        'r' => [
            'run:migrate - migrasi database'
        ]
    ];

    private static $colors = [
        'red' => "\033[31m",
        'green' => "\033[32m",
        'yellow' => "\033[33m",
        'blue' => "\033[34m",
        'reset' => "\033[0m"
    ];

    private static function textRed($text): string
    {
        return self::$colors['red'] . "{$text}" . self::$colors['reset'];
    }

    private static function textGreen($text): string
    {
        return self::$colors['green'] . "{$text}" . self::$colors['reset'];
    }

    private static function textYellow($text): string
    {
        return self::$colors['yellow'] . "{$text}" . self::$colors['reset'];
    }

    private static function textBlue($text): string
    {
        return self::$colors['blue'] . "{$text}" . self::$colors['reset'];
    }
}

