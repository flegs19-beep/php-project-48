# Вычислитель отличий

### Статус тестов и линтера Hexlet
[![Actions Status](https://github.com/flegs19-beep/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/flegs19-beep/php-project-48/actions)
[![PHP CI](https://github.com/flegs19-beep/php-project-48/actions/workflows/workflow.yml/badge.svg)](https://github.com/flegs19-beep/php-project-48/actions/workflows/workflow.yml)


### Sonar

[![Quality gate status](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=bugs)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=coverage)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Lines of Code](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=ncloc)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=reliability_rating)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=sqale_index)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=flegs19-beep_php-project-48&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=flegs19-beep_php-project-48)


## Описание

«Вычислитель отличий» — консольная утилита для сравнения двух файлов конфигурации. Программа определяет различия между файлами и выводит результат в выбранном формате. 

Поддерживаемые входные форматы:

- JSON
- YAML

Поддерживаемые форматы вывода:

- stylish
- plain
- json

## Системные требования

- PHP 8.2 или выше
- Composer
- Make

## Установка

Клонируйте репозиторий:

```bash
git clone https://github.com/flegs19-beep/php-project-48.git
cd php-project-48
```

## Установите зависимости:

```bash
make install
```

## Использование:

- Сравнение двух файлов в формате stylish:
```bash
bin/gendiff path/to/file1.json path/to/file2.json
```

- Сравнение в формате plain:
```bash
bin/gendiff --format plain path/to/file1.json path/to/file2.json
```

- Сравнение в формате json:
```bash
bin/gendiff --format json path/to/file1.json path/to/file2.json
```

## Gendiff — сравнение JSON-файлов

[https://youtu.be/3YhX7zuXSKc](https://youtu.be/3YhX7zuXSKc)

## Gendiff — сравнение YAML-файлов

[https://youtu.be/knlcfpfVadI](https://youtu.be/knlcfpfVadI)

## Gendiff — рекурсивное сравнение файлов

[https://youtu.be/utAlZHYT3ZM](https://youtu.be/utAlZHYT3ZM)

## Gendiff — плоский формат plain

[https://youtu.be/DwvsKS0hLFQ](https://youtu.be/DwvsKS0hLFQ)

## Gendiff — формат JSON

[https://youtu.be/7aUxKwUFXg4](https://youtu.be/7aUxKwUFXg4)