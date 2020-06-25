# Polly: a poll app

Polly is a plateform which permits to create et share polls.

## Contributing

### Requirements

Make sure that the following dependencies are installed:

- [Composer](https://getcomposer.org/)
- [Symfony](https://symfony.com/)

### 1. Running

Start a local MySQL instance.
Run the seed `.sql` file against your MySQL instance.

Install dependencies and start the server

```bash
$ composer install
$ symfony server:start
```

### 2. Running with Docker

Start MySQL

```bash
$ docker-compose up
```

Install dependencies and start the server

```bash
$ composer install
$ symfony server:start
```

## Codebase

#### Technologies

Here is a list of all the big technologies we use:

    - PHP (Symfony)
    - Javascript
    - HTML, CSS
