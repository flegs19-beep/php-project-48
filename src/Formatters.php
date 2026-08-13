<?php

namespace Differ\Formatters;

use function Differ\Formatters\Plain\format as formatPlain;
use function Differ\Formatters\Stylish\format as formatStylish;
use function Differ\Formatters\Json\format as formatJson;

function format(array $tree, string $formatName): string
{
    if ($formatName === 'plain') {
        return formatPlain($tree);
    }

    if ($formatName === 'json') {
        return formatJson($tree);
    }

    if ($formatName === 'stylish') {
        return formatStylish($tree);
    }
    throw new \Exception("Unknown format: {$formatName}");
}
