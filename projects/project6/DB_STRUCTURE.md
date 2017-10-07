# Database Information
Please be aware that for the site to operate fully, you must have a mySQL system set up on the same server as the website and configured with the correct database fields.

| [columnName]     |
|------------------|
| [type] (default) |
| [example]        |

# Connect.inc.php
This file is the main connection point into the database.


# Structure
Database Name: "project4_6"

Num of Tables: 2


## Table 1
Name: "article"

| articleID    | title      | body      | author  | date                         | deleted     |
|--------------|------------|-----------|---------|------------------------------|-------------|
| int(11) (AI) | text       | text      | int(11) | datetime (CURRENT_TIMESTAMP) | int(11) (0) |
| 1            | Test Title | [content] | Stephen | 2017-10-05 01:07:05          | 0           |


## Table 2
Name: "user"

| id           | username | passwordHash | firstName | lastName | email               | permission |
|--------------|----------|--------------|-----------|----------|---------------------|------------|
| int(11) (AI) | text     | text         | text      | text     | text                | int(11)    |
| 1            | sfloyd   | 5e52fee...   | Stephen   | Floyd    | stephen@example.com | 1          |