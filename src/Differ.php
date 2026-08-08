<?php

namespace Differ\Differ;

use function Differ\Formatters\Stylish\format;
use function Funct\Collection\sortBy;

function buildDiff(object $data1, object $data2): array
{
    $keys1 = array_keys(get_object_vars($data1));
    $keys2 = array_keys(get_object_vars($data2));

    $keys = array_unique(array_merge($keys1, $keys2));
    $sortedKeys = sortBy($keys, fn($key) => $key);

    return array_map(function ($key) use ($data1, $data2) {
        $hasKey1 = property_exists($data1, $key);
        $hasKey2 = property_exists($data2, $key);

        if (!$hasKey1) {
            return [
                'key' => $key,
                'type' => 'added',
                'value' => $data2->$key,
            ];
        }

        if (!$hasKey2) {
            return [
                'key' => $key,
                'type' => 'removed',
                'value' => $data1->$key,
            ];
        }

        $value1 = $data1->$key;
        $value2 = $data2->$key;

        if (is_object($value1) && is_object($value2)) {
            return [
                'key' => $key,
                'type' => 'nested',
                'children' => buildDiff($value1, $value2),
            ];
        }

        if ($value1 === $value2) {
            return [
                'key' => $key,
                'type' => 'unchanged',
                'value' => $value1,
            ];
        }

        return [
            'key' => $key,
            'type' => 'changed',
            'oldValue' => $value1,
            'newValue' => $value2,
        ];
    }, $sortedKeys);
}

function genDiff(
    string $filepath1,
    string $filepath2,
    string $formatName = 'stylish'
): string {
    $data1 = parseFile($filepath1);
    $data2 = parseFile($filepath2);

    $tree = buildDiff($data1, $data2);

    return format($tree);
}
