<?php

namespace Differ\Differ;

function resultArrayToResultString(array $resultDiffArr, string $format): array | string | bool | null
{
    return match ($format) {
        'stylish' => stylishFormattingOfDiffResult($resultDiffArr),
        'plain' => plainFormattingOfDiffResult($resultDiffArr),
        'json' => jsonFormattingOfDiffResult($resultDiffArr),
        default => "\nError. Unrecognised type of format ($format).\n",
    };
}