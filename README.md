# PHP Programmer Challenge

## Installation

Install dependencies:
```bash
composer install
```

Command to create database:
```bash
php bin/console doctrine:database:create
```

Create migrations:
```bash
php bin/console make:migration
```


Apply migrations:
```bash
php bin/console doctrine:migrations:migrate
```

`POST /register/`

`GET /register/`

Run command
```bash
 php bin/console avato:test arg1 arg2
```
`arg1: Input to generate key`
`arg2: Number of requests`