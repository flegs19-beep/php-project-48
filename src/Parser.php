<?php

namespace Differ\Differ;

function parseFile(string $filepath): object
{
    $content = file_get_contents($filepath);
    return json_decode($content);
}
