# Data Feed Application

## Overview
This application is designed to process XML data feeds and store the processed data in a database. It's built using the Symfony framework and provides a command-line interface for easy data manipulation.

## Features
- XML data parsing and processing
- Validation of data and files
- Flexible mapping of XML fields to database columns
  - Insertion of data into a database
  - Updates data if already exists (based on entity_id)
  - Efficient handling of large data feeds
- Keeps error log
- Ability to conduct PHP unit tests for comprehensive testing of the application

## Requirements
- PHP 8.2 or higher
- Symfony 7.0.2
- Composer for managing PHP dependencies
- Any choice of a database system (e.g MySQL)

## Installation
Clone the repository and install dependencies:
```bash
git clone https://github.com/AshikDev/data_feed_app.git
cd data_feed_app
composer install
```

Execute the following command to launch the **MySQL** container:
```bash
docker compose up -d
```

Execute the following commands to perform the database migration:
```bash
php bin/console make:migration
```
```bash
php bin/console doctrine:migrations:migrate
```

## Alternative Database Configurations (optional)
Configure your database of choice by editing the `.env` file.

### Alternatively configure MariaDB Credentials in `.env` file
Remove the comment mark from the line below:
```bash
# .env
DATABASE_URL="mysql://$MYSQL_USER:$MYSQL_PASSWORD@$MYSQL_HOST:$MYSQL_PORT/$DATABASE_NAME?serverVersion=$MARIADB_VERSION-MariaDB&charset=utf8mb4"
```

Execute the following command to launch the MariaDB container:
```bash
docker compose -f docker-compose-mariadb.yaml up -d
```

Execute the following commands to perform the database migration:
```bash
php bin/console make:migration
```
```bash
php bin/console doctrine:migrations:migrate
```

### Alternatively configure PostgreSQL Credentials in `.env` file
Remove the comment mark from the line below:
```bash
# .env
DATABASE_URL="postgresql://$POSTGRES_USER:$POSTGRES_PASSWORD@$POSTGRES_HOST:$POSTGRES_PORT/$DATABASE_NAME?serverVersion=$POSTGRES_VERSION&charset=utf8"
```

Execute the following command to launch the PostgreSQL container:
```bash
docker compose -f docker-compose-postgresql.yaml up -d
```

Execute the following commands to perform the database migration:
```bash
php bin/console make:migration
```
```bash
php bin/console doctrine:migrations:migrate
```

### Alternatively configure SQLite Credentials in `.env` file
Remove the comment mark from the line below:
```bash
# .env
DATABASE_URL="sqlite:///%kernel.project_dir%/var/sqlite/data_feed.db"
```

Execute the following commands to perform the database migration:
```bash
php bin/console make:migration
```
```bash
php bin/console doctrine:migrations:migrate
```

# Usage
### Feed Data
Execute the `DataFeed` command with the path to your XML file:

```bash
php bin/console DataFeed /path/to/your/feed.xml
```

### Error Log

Error logs are saved in `var/log/error.log`.
Execute the following command to see the error log:

```bash
tail var/log/error.log
```

Or view the live error log.

```bash
tail -f var/log/error.log
```

Execute the `ClearLog` command to clean the error log:

```bash
php bin/console ClearLog
```

### Unit Test

To test the application for a successful scenario, run the following command:

```bash
php bin/phpunit --filter testExecute tests/Command/DataFeedCommandTest.php
```

To test the application for a failure scenario, run the following command:

```bash
php bin/phpunit --filter testExecuteFailure tests/Command/DataFeedCommandTest.php
```

# Expected Output

Console output should show 3446 rows saved out of 3449 from the specified XML file, as three rows lack required criteria based on my database design. The output is provided below:

`[INFO] Processing XML file`

`[INFO] Reading XML Data`

`[INFO] Storing XML Data`

`20:51:34 ERROR     [app] Entity Id: 4450. Price is required.`

`20:51:34 ERROR     [app] Entity Id: 4458. Name is required.`

`20:51:35 ERROR     [app] Entity Id: 5124. Name is required.`

`[INFO] 3446 rows are saved`

`[OK] Done`


# File Navigation:

I've completed my tasks on the specified files and am providing the path for your review.

#### Data feed console program

`src/Command/DataFeedCommand.php`

#### PHP unit test

`tests/Command/DataFeedCommandTest.php`

#### Clean Log File

`src/Command/ClearLogFileCommand.php`

#### Entity

`src/Entity/CatalogItem.php`

#### Repository

`src/Repository/CatalogItemRepository.php`

#### DataFeed Static Configurations (Property Maps, Required Fields)

`src/Service/DataFeedConfiguration.php`

#### SQLite Path (if you want to use)

`var/sqlite/data_feed.db`

# NOTE

**Alternatively:** If the necessary environment isn't set up, use Docker to run the console app. The provided Dockerfile should be incorporated as a service in a YAML file of your choosing. After adding this, execute the command `docker compose up -d` to start the service. e.g.

```bash
services:
  data_feed_app:
    build: .
    volumes:
      - .:/app
    depends_on:
      - mysql
```