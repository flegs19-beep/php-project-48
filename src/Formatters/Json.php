<?php

namespace Differ\Formatters\Json;

function format(array $tree): string
{
    return json_encode($tree, JSON_THROW_ON_ERROR);
}
