<?php

namespace Differ\Format\Json;

function jsonFormattingOfDiffResult(array $resultDiffArr): string|false
{
    return json_encode($resultDiffArr);
}
