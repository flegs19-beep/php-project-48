<?php

namespace Hexlet\Code;

function parseFile(string $filepath): object
{
    $content = file_get_contents($filepath);
    return json_decode($content);
}