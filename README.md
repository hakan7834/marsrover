# Mars Rover Api

[API Documentation Demo](https://rover.hakanakhan.com/v1/doc)

[Demo](https://rover.hakanakhan.com)

## INDEX

- [Server Requirements](https://github.com/hakan7834/marsrover#server-requirements)

- [Running App](https://github.com/hakan7834/marsrover#running-app)

- [API Documentation](https://github.com/hakan7834/marsrover#api-documentation)

- [Unit Test](https://github.com/hakan7834/marsrover#unit-test)

- [Codeigniter Info](https://github.com/hakan7834/marsrover#codeigniter-info)

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:
- php-zip
- [php-intl](http://php.net/manual/en/intl.requirements.php)

## Running App

The following tools can be used for running application:
- DockerHub [ Recomended ]
- Dockerfile
- Docker-compose
- Spark
- Apache

OR The App live version can be found in 
[https://rover.hakanakhan.com](https://rover.hakanakhan.com).

- ### DockerHub [ Recomended ]

The following code can be run in the terminal:
```bash
docker run -dit -p 80:80 --name marsrover hakanakhan/marsrover:v1
```
The App can be viewed in the following url:

`http://localhost`  or `http://your-domain`

For diffrent port:

```bash
docker run -dit -p [port]:80 --name marsrover hakanakhan/marsrover:v1
```
The App can be viewed in the following url:

`http://localhost:[port]`  or `http://your-domain[port]`

- ### Docker-compose

The following code can be run in the terminal 
```bash
git clone https://github.com/hakan7834/marsrover.git
cd marsrover
docker-compose up -d
```
The App can be viewed by: 

`http://localhost`  or `http://your-domain`

- ### Dockerfile

The following code can be run in the terminal:
```bash
git clone https://github.com/hakan7834/marsrover.git
cd marsrover
docker build -t roverapp:v1 .
docker run -dit -p 80:80 --name marsrover roverapp:v1
```
The App can be viewed in the following url:

`http://localhost`  or `http://your-domain`

#### !!! IMPORTANT !!!

Make sure writable/ directory is writable for spark and apache

```bash
chmod -R 777 writable/ 
```


- ### Spark

```bash
git clone https://github.com/hakan7834/marsrover.git
cd marsrover
composer install
chmod -R 777 writable/ 
php spark serve --port 8081
```
The App can be viewed in the following url:

`http://localhost:8081`  or `http://your-domain:8081`

- ### Apache

Apache conf files can be edited in /etc/apache2/sites-available folder and activate rewrite extension of apache
```bash
git clone https://github.com/hakan7834/marsrover.git
cd marsrover
chmod -R 777 writable/
a2enmod rewrite
service apache2 restart
composer install
```

## API Documentation

Mars Rover Api uses swagger  

`http://localhost/v1/doc`  or `http://[your-domain.com]/v1/doc`

Or the api documentation live version can be found:
[here](https://rover.hakanakhan.com/v1/doc).

## Unit Test

Mars Rover app test folder:

`[ROOTPATH]/tests/app`

- ### Docker

```bash
docker exec -it marsrover bash
./vendor/bin/phpunit
```

- ### Others

PHPUnit can be run in terminal with the following code:
```bash
composer install ##if not run before
./vendor/bin/phpunit
```

![PHPUnit Image](https://github.com/hakan7834/marsrover/blob/main/public/phpunit.png?raw=true)

## Codeigniter Info

- ### Configuration Paths

Controllers Folder can be found in the following path:

`[ROOTPATH]/app/Controllers`

Models Folder can be found in the following path:

`[ROOTPATH]/app/Models`

Views Folder can be found in the following path:

`[ROOTPATH]/app/Views`

Config files can be changed in the following path:

`[ROOTPATH]/app/Config` or `[ROOTPATH]/.env`

- ### Database

Database uses SQLite3

Database paths:

default: `/tmp/db1.db` 
tests: `/tmp/db2.db` 

This value can be changed from the following configuration files:

`[ROOTPATH]/app/Config/Database.php` or `[ROOTPATH]/.env`

