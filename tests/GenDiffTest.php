<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\Differ\gendiff;

class GenDiffTest extends TestCase
{
    /**
     * @dataProvider diffTwoFileProvider
     *
     * @param string $file1
     * @param string $file2
     * @param string $format
     * @param string $expected
     * @return void
     */
    public function testGendiffTwofile(string $file1, string $file2, string $format, string $expected)
    {
        $fixture1 = $this->getFullPathToFile($file1);
        $fixture2 = $this->getFullPathToFile($file2);
        $expectedDiff = $this->getFullPathToFile($expected);
        $this->assertStringEqualsFile($expectedDiff, gendiff($fixture1, $fixture2, $format));
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function diffTwoFileProvider(): array
    {
        return [
            [
                "filepath1.json",
                "filepath2.json",
                "stylish",
                "Stylish.txt"
            ],
            [
                "filepath1.yaml",
                "filepath2.yaml",
                "stylish",
                "Stylish.txt"
            ],
            [
                "filepath1.json",
                "filepath2.json",
                "plain",
                "Plain.txt"
            ],
            [
                "filepath1.yaml",
                "filepath2.yaml",
                "plain",
                "Plain.txt"
            ],
            [
                "filepath1.json",
                "filepath2.json",
                "json",
                "Json.txt"
            ],
            [
                "filepath1.yaml",
                "filepath2.yaml",
                "json",
                "Json.txt"
            ]
        ];
    }

    /**
     * @param string $path
     * @return string
     */
    private function getFullPathToFile(string $path): string
    {
        return __DIR__ . "/fixtures/" . $path;
    }
}