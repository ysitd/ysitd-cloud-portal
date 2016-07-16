# YSITD Cloud Portal

This is providing a web interface to manage own resources and account in YSITD Cloud.

## Requirement
1. node.js 4 LTS
2. PostgreSQL 9.3+ (Remote Server and Client)
3. Redis 3
4. Nginx (Optional)

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
$ gulp dev &
$ npm run dev
```

