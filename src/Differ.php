<?php

namespace Differ\Differ;

use function Differ\Parsers\getAssocArrayFromFile;
use function Differ\Formatters\format;

//Головная функция дифа
function genDiff(string $File1, string $File2, string $Format = 'stylish'): array | bool | string | null
{
    $arr1 = getAssocArrayFromFile($File1);
    $arr2 = getAssocArrayFromFile($File2);
    $resultDiffArr = genDiffFromArrays($arr1, $arr2);
    return format($resultDiffArr, $Format);
}

//Генерируем результирующий массив отличий 2-ух массивов
function genDiffFromArrays(array $arr1, array $arr2): array
{
    $mergedAndSortedArrays = mergeAndSortArrays($arr1, $arr2);
    return array_map(function ($nodeData) use ($arr1, $arr2) {
        if (!key_exists($nodeData['nodeKey'], $arr1) && key_exists($nodeData['nodeKey'], $arr2)) {
            return ['nodeKey' => $nodeData['nodeKey'], 'nodeValue' => $nodeData['child'], 'diffStatus' => 'added'];
        } elseif (key_exists($nodeData['nodeKey'], $arr1) && !key_exists($nodeData['nodeKey'], $arr2)) {
            return ['nodeKey' => $nodeData['nodeKey'], 'nodeValue' => $nodeData['child'], 'diffStatus' => 'deleted'];
        } else {
            if ($arr1[$nodeData['nodeKey']] === $arr2[$nodeData['nodeKey']]) {
                return [
                    'nodeKey' => $nodeData['nodeKey'],
                    'nodeValue' => $nodeData['child'],
                    'diffStatus' => 'unchanged'
                ];
            } else {
                if (is_array($arr1[$nodeData['nodeKey']]) && is_array($arr2[$nodeData['nodeKey']])) {
                    return [
                        'nodeKey' => $nodeData['nodeKey'],
                        'child' => genDiffFromArrays($arr1[$nodeData['nodeKey']], $arr2[$nodeData['nodeKey']])
                    ];
                } else {
                    return [
                        'nodeKey' => $nodeData['nodeKey'],
                        'nodeValueOld' => $arr1[$nodeData['nodeKey']],
                        'nodeValueNew' => $arr2[$nodeData['nodeKey']],
                        'diffStatus' => 'updated'
                    ];
                }
            }
        }
    }, $mergedAndSortedArrays);
}

//Складываем массивы в один, сортируем и подготавливаем начальную структуру для дальнейшего поиска отличий
function mergeAndSortArrays(array $arr1, array $arr2): array
{
    $merged = $arr2 + $arr1;
    $reduced = array_map(
        fn($nodeKey, $child) => ['nodeKey' => $nodeKey, 'child' => $child],
        array_keys($merged),
        array_values($merged)
    );
    return array_values(collect($reduced)->sort()->values()->all());
}