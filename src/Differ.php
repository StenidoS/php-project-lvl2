<?php

namespace Differ\Differ;

use Exception;

use function Differ\Parsers\getAssocArrayFromFile;
use function Differ\Formatters\format;
use function Differ\BuildAst\buildAst;

/**
 * @param string $firstFile
 * @param string $secondFile
 * @param string $format
 * @return string
 * @throws Exception
 */
function genDiff(string $firstFile, string $secondFile, string $format = 'stylish'): string
{
    $firstContent = getContentFromFileAndParse($firstFile);
    $secondContent = getContentFromFileAndParse($secondFile);
    $ast = buildAst($firstContent, $secondContent);

    return format($ast, $format);
}

/**
 * @param string $file
 * @return array<string>
 * @throws Exception
 */
    function getContentFromFileAndParse(string $file): array
    {
        $fileWithFullPath = getFullPathToFile($file);
        $fileContent = file_get_contents($fileWithFullPath);
            if ($fileContent === false) {
                throw new Exception("Can't read file");
            }
        $fileType = pathinfo($fileWithFullPath, PATHINFO_EXTENSION);
            return getAssocArrayFromFile($fileType, $fileContent);
    }

    /**
    * @param string $file
    * @return string
    */
    function getFullPathToFile(string $file): string
    {
        if (str_starts_with($file, '/')) {
            return $file;
        }

        return __DIR__ . '/../' . $file;
    }