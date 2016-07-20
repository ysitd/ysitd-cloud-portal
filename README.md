# YSITD Cloud Portal

![License](https://img.shields.io/badge/License-MIT-brightgreen.svg)

This is providing a web interface to manage own resources and account in YSITD Cloud.

## Table of content

* [Requirement](#requirement)
* [Install](#install)

## Requirement
1. node.js 4 LTS
2. PostgreSQL 9.3+ (Remote Server and Client)
3. Redis 3
4. Nginx
5. PHP 5.5.9+

## Install

The config is stored in the .env file

### Production

```bash
$ composer install --no-dev --prefer-dist -o
$ psql -d <database> -h <host> -p <port> -U <username> -a -W -f db/structure.sql
$ nano .env
```

### Development

```bash
$ composer install
$ psql -d <database> -h <host> -p <port> -U <username> -a -W -f db/structure.sql
$ nano .env
```
