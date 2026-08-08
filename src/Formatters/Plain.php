<?php

namespace Differ\Formatters\Plain;

function stringify(mixed $value): string
{
    if (is_object($value)) {
        return '[complex value]';
    }

    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if ($value === null) {
        return 'null';
    }

    if (is_string($value)) {
        return "'{$value}'";
    }

    return (string) $value;
}

function format(array $tree, string $path = ''): string
{
    $lines = array_map(function ($node) use ($path) {
        $key = $node['key'];
        $propertyPath = $path === '' ? $key : "{$path}.{$key}";

        switch ($node['type']) {
            case 'nested':
                return format($node['children'], $propertyPath);

            case 'added':
                $value = stringify($node['value']);
                return "Property '{$propertyPath}' was added with value: {$value}";

            case 'removed':
                return "Property '{$propertyPath}' was removed";

            case 'changed':
                $oldValue = stringify($node['oldValue']);
                $newValue = stringify($node['newValue']);

                return "Property '{$propertyPath}' was updated. From {$oldValue} to {$newValue}";

            case 'unchanged':
                return '';
        }

        return '';
    }, $tree);

    return implode("\n", array_filter($lines));
}
