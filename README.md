### Это демо приложение создано на основе PCore Framework

---

### Запуск

#### С помощью Swoole

```shell
php bin/swoole.php
```

---

#### С помощью Workerman

```shell
php bin/workerman.php start
```

---

#### С помощью FPM

<details>
<summary>Подробнее ...</summary>

###### В режиме fpm укажите запросы на bin/fpm.php

#### Nginx

```shell
server {
    listen 80;
    listen [::]:80;
    server_name example.com;
    root /var/www/bin;
    index fpm.php;
    location / {
        if (!-e $request_filename) {
            rewrite ^/(.*)$ /fpm.php/$1 last;
        }
    }
    location ~ ^(.+\.php)(.*)$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_split_path_info ^(.+\.php)(.*)$;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

</details>

#### С помощью Watch

```shell
php bin/watch.php
```

#### С помощью Swoole WebScket

```shell
php bin/swoolews.php
```

---

[Документация](https://github.com/pcore-framework/docs)

---

[Создать новый проект](https://github.com/pcore-framework)
