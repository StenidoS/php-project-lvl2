<?php

namespace Differ\Formatters;

use function Differ\Format\Json\jsonFormattingOfDiffResult;
use function Differ\Format\Plain\plainFormattingOfDiffResult;
use function Differ\Format\Stylish\stylishFormattingOfDiffResult;

function resultArrayToResultString(array $resultDiffArr, string $format): array | string | bool | null
{
    return match ($format) {
        'stylish' => stylishFormattingOfDiffResult($resultDiffArr),
        'plain' => plainFormattingOfDiffResult($resultDiffArr),
        'json' => jsonFormattingOfDiffResult($resultDiffArr),
        default => "\nError. Unrecognised type of format ($format).\n",
    };
}