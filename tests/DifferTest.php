<?php

namespace Differ\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    #[DataProvider('diffProvider')]
    public function testGenDiff(
        string $extension,
        string $format,
        string $expectedFile
    ): void {
        $file1 = __DIR__ . "/fixtures/file1.{$extension}";
        $file2 = __DIR__ . "/fixtures/file2.{$extension}";
        $expectedPath = __DIR__ . "/fixtures/{$expectedFile}";

        $actual = genDiff($file1, $file2, $format);

        $this->assertStringEqualsFile(
            $expectedPath,
            $actual
        );

    }

    #[DataProvider('defaultFormatProvider')]
    public function testGenDiffWithDefaultFormat(string $extension): void
    {
        $file1 = __DIR__ . "/fixtures/file1.{$extension}";
        $file2 = __DIR__ . "/fixtures/file2.{$extension}";
        $expectedPath = __DIR__ . '/fixtures/expected_stylish.txt';

        $actual = genDiff($file1, $file2);

        $this->assertStringEqualsFile(
            $expectedPath,
            $actual
        );
    }


    public static function diffProvider(): array
    {
        return [
            'json stylish' => [
                'json',
                'stylish',
                'expected_stylish.txt',
            ],
            'yaml stylish' => [
                'yml',
                'stylish',
                'expected_stylish.txt',
            ],
            'json plain' => [
                'json',
                'plain',
                'expected_plain.txt',
            ],
            'yaml plain' => [
                'yml',
                'plain',
                'expected_plain.txt',
            ],
            'json json' => [
                'json',
                'json',
                'expected_json.json',
            ],
            'yaml json' => [
                'yml',
                'json',
                'expected_json.json',
            ],
        ];
    }

    public static function defaultFormatProvider(): array
    {
        return [
            'json default' => ['json'],
            'yaml default' => ['yml'],
        ];
    }

}
