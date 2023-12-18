<?php

namespace Differ\Formatters;

use function Differ\Format\Json\jsonFormattingOfDiffResult;
use function Differ\Format\Plain\plainFormattingOfDiffResult;
use function Differ\Format\Stylish\stylishFormattingOfDiffResult;

//Цель этой функции - преобразовать данный массив resultDiffArr в отформатированную строку в соответствии с указанным форматом.

function resultArrayToResultString(array $resultDiffArr, string $format): array | string | bool | null
{
    //Функция использует выражение match, чтобы определить формат и вызвать соответствующую функцию форматирования
    return match ($format) {
        'stylish' => stylishFormattingOfDiffResult($resultDiffArr),
        'plain' => plainFormattingOfDiffResult($resultDiffArr),
        'json' => jsonFormattingOfDiffResult($resultDiffArr),
        //Если формат не распознан, функция возвращает строку с сообщением об ошибке.
        default => "\nError. Unrecognised type of format ($format).\n",
    };
}