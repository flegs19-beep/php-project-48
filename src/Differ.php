<?php

namespace Differ\Differ;

use function Funct\Collection\sortBy;
use function Differ\Formatters\format;
use function Differ\Parsers\parse;

function genDiff(
    string $filepath1,
    string $filepath2,
    string $formatName = 'stylish'
): string {
    $content1 = getFileContent($filepath1);
    $content2 = getFileContent($filepath2);

    $format1 = pathinfo($filepath1, PATHINFO_EXTENSION);
    $format2 = pathinfo($filepath2, PATHINFO_EXTENSION);

    $data1 = parse($content1, $format1);
    $data2 = parse($content2, $format2);

    $tree = buildDiff($data1, $data2);

    return format($tree, $formatName);
}


function buildDiff(object $data1, object $data2): array
{
    $keys1 = array_keys(get_object_vars($data1));
    $keys2 = array_keys(get_object_vars($data2));

    $keys = array_unique(array_merge($keys1, $keys2));
    $sortedKeys = array_values(sortBy($keys, fn($key) => $key));

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

function getFileContent(string $filepath): string
{
    if (!file_exists($filepath)) {
        throw new \Exception("File not found: {$filepath}");
    }

    $content = file_get_contents($filepath);

    if ($content === false) {
        throw new \Exception("Unable to read file: {$filepath}");
    }

    return $content;
}
