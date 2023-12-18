<?php

namespace Differ\Format\Json;

function jsonFormattingOfDiffResult(array $resultDiffArr): false|string
{
    return json_encode($resultDiffArr);
}
