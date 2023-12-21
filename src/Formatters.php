<?php

namespace Differ\Formatters;

use function Differ\Format\Plain\plainFormattingOfDiffResult as formatPlain;
use function Differ\Format\Stylish\stylishFormattingOfDiffResult as formatStylish;
use function Differ\Format\Json\jsonFormattingOfDiffResult as formatJson;

/**
 * @param array<mixed> $ast
 * @param string $format
 * @return string
 */
function format(array $ast, string $format): string
{
    switch ($format) {
        case "stylish":
            return formatStylish($ast);
        case "plain":
            return formatPlain($ast);
        case "json":
            return formatJson($ast);
        default:
            throw new \Exception('Unknown format: ' . $format);
    }
}