# YSITD Cloud Portal

[![dependency status](https://david-dm.org/ysitd/ysitd-cloud-portal.svg)](https://david-dm.org/ysitd/ysitd-cloud-portal)
![License](https://img.shields.io/badge/License-MIT-brightgreen.svg)

This is providing a web interface to manage own resources and account in YSITD Cloud.

## Table of content

* [Requirement](#requirement)
* [File Structure](#file-structure)
* [Install](#install)

## Requirement
1. node.js 4 LTS
2. PostgreSQL 9.3+ (Remote Server and Client)
3. Redis 3
4. Nginx (Optional)

## File Structure

```
ysitd-cloud-portal/
├── assets
│   ├── images
│   ├── js
│   └── scss
├── bin
│   └── web
├── db
│   └── structure.sql
├── public
│   ├── robot.text
│   └── favicon.ico
├── src
├── storages
│   └── logs
├── tests
├── views
├── .env
├── .env.example
├── .gitignore
├── app.json
├── gulpfile.babel.js
├── LICENSE.md
├── package.json
└── README.md
```

## Install

The config is stored in the .env file

### Production

```bash
$ npm install --production
$ psql -d <database> -h <host> -p <port> -U <username> -a -W -f db/structure.sql
$ cp .env.example .env
$ nano .env
$ npm run cluster
```

### Development

```bash
$ npm install
$ psql -h <host> -p <port> -U <username> -d <database> -a -W -f db/structure.sql
$ cp .env.example .env
$ nano .env
$ npm run dev
```

