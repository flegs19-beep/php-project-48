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
    $keys = array_keys(get_object_vars($value));

    $lines = array_map(
        fn($key) => sprintf(
            '%s%s: %s',
            $indent,
            $key,
            stringify($value->$key, $depth + 1)
        ),
        $keys
    );

    return sprintf(
        "{\n%s\n%s}",
        implode("\n", $lines),
        $bracketIndent
    );
}

function format(array $tree, int $depth = 1): string
{
    $indent = str_repeat(' ', $depth * 4 - 2);

    $lines = array_map(function ($node) use ($depth, $indent) {
        $key = $node['key'];

        switch ($node['type']) {
            case 'nested':
                $children = format($node['children'], $depth + 1);

                return sprintf(
                    '%s  %s: %s',
                    $indent,
                    $key,
                    $children
                );

            case 'unchanged':
                return sprintf(
                    '%s  %s: %s',
                    $indent,
                    $key,
                    stringify($node['value'], $depth)
                );

            case 'removed':
                return sprintf(
                    '%s- %s: %s',
                    $indent,
                    $key,
                    stringify($node['value'], $depth)
                );

            case 'added':
                return sprintf(
                    '%s+ %s: %s',
                    $indent,
                    $key,
                    stringify($node['value'], $depth)
                );

            case 'changed':
                return sprintf(
                    "%s- %s: %s\n%s+ %s: %s",
                    $indent,
                    $key,
                    stringify($node['oldValue'], $depth),
                    $indent,
                    $key,
                    stringify($node['newValue'], $depth)
                );
        }

        return '';
    }, $tree);

    $bracketIndent = str_repeat(' ', ($depth - 1) * 4);

    return sprintf(
        "{\n%s\n%s}",
        implode("\n", $lines),
        $bracketIndent
    );
}
