<?php

namespace Differ\Formatters\Stylish;

function stringify(mixed $value, int $depth): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if ($value === null) {
        return 'null';
    }

    if (!is_object($value)) {
        return (string) $value;
    }

    $indent = str_repeat(' ', ($depth + 1) * 4);
    $bracketIndent = str_repeat(' ', $depth * 4);

    $lines = array_map(
        fn($key) => "{$indent}{$key}: " . stringify($value->$key, $depth + 1),
        array_keys(get_object_vars($value))
    );

    return "{\n" . implode("\n", $lines) . "\n{$bracketIndent}}";
}

function format(array $tree, int $depth = 1): string
{
    $indent = str_repeat(' ', $depth * 4 - 2);

    $lines = array_map(function ($node) use ($depth, $indent) {
        $key = $node['key'];

        switch ($node['type']) {
            case 'nested':
                $children = format($node['children'], $depth + 1);
                return "{$indent}  {$key}: {$children}";

            case 'unchanged':
                return "{$indent}  {$key}: " . stringify($node['value'], $depth);

            case 'removed':
                return "{$indent}- {$key}: " . stringify($node['value'], $depth);

            case 'added':
                return "{$indent}+ {$key}: " . stringify($node['value'], $depth);

            case 'changed':
                return "{$indent}- {$key}: " . stringify($node['oldValue'], $depth)
                    . "\n{$indent}+ {$key}: " . stringify($node['newValue'], $depth);
        }

        return '';
    }, $tree);

    $bracketIndent = str_repeat(' ', ($depth - 1) * 4);

    return "{\n" . implode("\n", $lines) . "\n{$bracketIndent}}";
}
