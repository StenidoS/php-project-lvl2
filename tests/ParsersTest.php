<?php

//Модуль тестирования парсингов файлов в массивы

namespace Differ\Differ;

use PHPUnit\Framework\TestCase;

class ParsersTest extends TestCase
{
    private static string $parseFileRightResult = 'Array
(
    [host] => hexlet.io
    [timeout] => 50
    [proxy] => 123.234.53.22
    [follow] => 
)';

    public function testParsingJson(): void
    {
        $ParseJsonTestResult = getAssocArrayFromFile(__DIR__ . '/fixtures/file1.json');
        $this->expectOutputString(static::$parseFileRightResult);
        print_r($ParseJsonTestResult);
    }

    public function testParsingYaml(): void
    {
        $ParseYamlTestResult = getAssocArrayFromFile(__DIR__ . '/fixtures/file1.yaml');
        $this->expectOutputString(static::$parseFileRightResult);
        print_r($ParseYamlTestResult);
    }
}
