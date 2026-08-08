<?php

namespace Differ\Formatters;

use function Differ\Formatters\Plain\format as formatPlain;
use function Differ\Formatters\Stylish\format as formatStylish;

function format(array $tree, string $formatName): string
{
    if ($formatName === 'plain') {
        return formatPlain($tree);
    }

    return formatStylish($tree);
}
