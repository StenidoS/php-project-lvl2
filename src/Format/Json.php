<?php

namespace Differ\Format\Json;

function jsonFormattingOfDiffResult(array $resultDiffArr): string | bool
{
    return json_encode($resultDiffArr, JSON_PRETTY_PRINT);
}
