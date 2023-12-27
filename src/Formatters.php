<?php

namespace Differ\Formatters;

use function Differ\Format\Plain\plainFormattingOfDiffResult as formatPlain;
use function Differ\Format\Stylish\stylishFormattingOfDiffResult as formatStylish;
use function Differ\Format\Json\jsonFormattingOfDiffResult as formatJson;

/**
 * @param array<mixed> $ast
 * @param string $format
 * @return string
 * @throws \Exception
 */
function format(array $ast, string $format): string
{
    return match ($format) {
        "stylish" => formatStylish($ast),
        "plain" => formatPlain($ast),
        "json" => formatJson($ast),
        default => throw new \Exception('Unknown format: ' . $format),
    };
}