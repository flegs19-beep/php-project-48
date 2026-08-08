<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $data, string $format): object
{
    if ($format === 'json') {
        return json_decode($data);
    }

    if ($format === 'yml' || $format === 'yaml') {
        return Yaml::parse($data, Yaml::PARSE_OBJECT_FOR_MAP);
    }

    throw new \Exception("Unknown format: {$format}");
}
