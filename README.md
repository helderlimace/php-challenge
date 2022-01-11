# PHP Programmer Challenge
## Candidate: Helder Lima

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
```
> POST /register/ HTTP/1.1
> Host: localhost:port
> User-Agent: insomnia/2021.7.2
> Content-Type: application/x-www-form-urlencoded
> Accept: */*
> Content-Length: 13
| name=string
```

`GET /register/`
```
> GET /register/ HTTP/1.1
> Host: localhost:port
> User-Agent: insomnia/2021.7.2
> Content-Type: application/x-www-form-urlencoded
> Accept: */*
> Content-Length: 13
```

Run command
```bash
 php bin/console avato:test arg1 arg2
```
`arg1: Input to generate key`
`arg2: Number of requests`