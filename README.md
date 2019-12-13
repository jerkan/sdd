# SDD Brand Care Test

SDD Brand Care PHP Backend test

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Docker


### Installing

A step by step series of examples that tell you how to get a development env running

Docker container

```
docker-compose up -d
```

PHP dependencies (Composer)

```
docker exec -it sdd_app_1 composer install
```

Create the local database

```
docker exec -it sdd_app_1 php bin/console doc:database:create
docker exec -it sdd_app_1 php bin/console doc:mig:mig
```

## Tests

Create test database
```
docker exec -it sdd_app_1 php bin/console doc:database:create --env=test
docker exec -it sdd_app_1 php bin/console doc:schema:update --env=test
```

Run tests
```
docker exec -it sdd_app_1 php bin/phpunit
```


## Built With

* Symfony


## Authors

* **Rodrigo Pérez** 
