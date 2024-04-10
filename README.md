# Data Feed Application

## Table of Contents

- [Overview](#overview)
- [Feature](#feature)
- [Requirements](#requirements)
- [Installation](#installation)
- [Alternative Database Configurations](#alternative-database-configurations)
- [Usage](#usage)
- [Expected Output](#expected-output)
- [File Structure](#file-structure)

## Overview
This Symfony application validates, parses, and stores XML data in a database.

## Feature
- **File Validation:** Validates files by path, type, and size.
- **Data Parsing:**
  - Validates the integrity and format of data.
  - Reads and processes XML data in chunks, optimizing memory usage.
- **Data Storage:**
  - Validates required fields.
  - Maps XML fields to database columns flexibly.
  - Handles data insertion and updates.
  - Manages memory efficiently during batch operations.
**Logging:** Maintains comprehensive error and operation logs.
**Testing:** Ensures reliability with extensive PHP unit tests.

## Requirements
- PHP 8.2 or higher
- Symfony 7.0.2
- Composer for managing PHP dependencies
- Any choice of a database system (e.g MySQL)

## Installation
Clone the repository and install dependencies:
```bash
git clone https://github.com/AshikDev/data_feed.git
cd data_feed
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

## Alternative Database Configurations
This step is optional. Configure your database of choice by editing the `.env` file.

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

`[INFO] Validating XML file`

`[INFO] Parsing and Storing XML Data`

`20:51:34 ERROR     [app] Entity Id: 4450. Price is required.`

`20:51:34 ERROR     [app] Entity Id: 4458. Name is required.`

`20:51:35 ERROR     [app] Entity Id: 5124. Name is required.`

`! [NOTE] 3446 row are saved  `

`[OK] Done`

# File Structure:

I've completed my tasks on the specified files and am providing the path for your review.

#### Data feed console program

`src/Command/DataFeedCommand.php`

#### PHP unit test

`tests/Command/DataFeedCommandTest.php`