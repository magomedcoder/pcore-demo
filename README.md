## PCore framework

<p align="center">
    <img src="https://avatars.githubusercontent.com/u/106922419?s=200&v=4" width="120" alt="PCore framework">
</p>

[![PHP Version](https://img.shields.io/badge/php-%3E=8.0-brightgreen.svg)](https://www.php.net)
[![Swoole Version](https://img.shields.io/badge/swoole-%3E=4.8.*-brightgreen.svg)](https://github.com/swoole/swoole-src)

### Создаем проект через Composer

```shell
composer create-project pcore/skeleton my-project < название вашего проекта
```

### Консольные команды

```shell
php bin/console.php make:controller
php bin/console.php make:middleware
php bin/console.php make:model
php bin/console.php route:list
```

## Запуск

#### С помощью swoole

```shell
php bin/swoole.php
```

#### С помощью fpm

###### В режиме fpm укажите запросы на bin/fpm.php

#### Nginx

```shell
location / {
  try_files $uri $uri/ /bin/fpm.php?$query_string;
}
```