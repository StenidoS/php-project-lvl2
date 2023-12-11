<?php

namespace Differ\Differ;
function plainFormattingOfDiffResult(array $resultDiffArr, string $parents = ''): string
{
    $plainResultArr = array_map(function ($node) use ($parents): string {
        if (array_key_exists('diffStatus', $node)) {
            switch ($node['diffStatus']) {
                case 'updated':
                    $Old = simpleOrCompVal($node['nodeValueOld']);
                    $New = simpleOrCompVal($node['nodeValueNew']);
                    return "Property '$parents" . $node['nodeKey'] . "' was updated. From $Old to $New";
                case 'deleted':
                    return "Property '$parents" . $node['nodeKey'] . "' was removed";
                case 'added':
                    $nodeValue = simpleOrCompVal($node['nodeValue']);
                    return "Property '$parents" . $node['nodeKey'] . "' was added with value: $nodeValue";
            }
        } else {
            $parentsForIter = $parents . $node['nodeKey'] . '.';
            return plainFormattingOfDiffResult($node['child'], $parentsForIter);
        }
        return '';
    }, $resultDiffArr);
    $filteredPlainResultArr = array_filter($plainResultArr, fn($row) => $row != '');
    return implode("\n", $filteredPlainResultArr);
}

function simpleOrCompVal(mixed $value): string|int
{
    return (is_array($value)) ? '[complex value]' : ifBoolOr0ToString($value);
}

function ifBoolOr0ToString(mixed $value): string|int
{
    if ($value === true) {
        return 'true';
    } elseif ($value === false) {
        return 'false';
    } elseif ($value === null) {
        return 'null';
    } elseif ($value === 0) {
        return 0;
    }
    return "'$value'";
}
