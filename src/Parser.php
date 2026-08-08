<?php

namespace Differ\Differ;

use function Differ\Parsers\parse;

function parseFile(string $filepath): object
{
    $content = file_get_contents($filepath);
    $format = pathinfo($filepath, PATHINFO_EXTENSION);

    return parse($content, $format);
}