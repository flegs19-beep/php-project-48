<?php

namespace Differ\Differ;

use function Funct\Collection\sortBy;

function stringifyValue(mixed $value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    return (string) $value;
}

function genDiff(string $filepath1, string $filepath2): string
{
    $data1 = parseFile($filepath1);
    $data2 = parseFile($filepath2);

    $keys1 = array_keys(get_object_vars($data1));
    $keys2 = array_keys(get_object_vars($data2));

    $keys = array_unique(array_merge($keys1, $keys2));
    $sortedKeys = sortBy($keys, fn($key) => $key);

    $lines = array_map(function ($key) use ($data1, $data2) {
        $hasKey1 = property_exists($data1, $key);
        $hasKey2 = property_exists($data2, $key);

        if ($hasKey1 && !$hasKey2) {
            return "- {$key}: " . stringifyValue($data1->$key);
        }

        if (!$hasKey1 && $hasKey2) {
            return "+ {$key}: " . stringifyValue($data2->$key);
        }

        if ($data1->$key === $data2->$key) {
            return "  {$key}: " . stringifyValue($data1->$key);
        }

        return "- {$key}: " . stringifyValue($data1->$key)
            . "\n+ {$key}: " . stringifyValue($data2->$key);
    }, $sortedKeys);

    return "{\n" . implode("\n", $lines) . "\n}";
}