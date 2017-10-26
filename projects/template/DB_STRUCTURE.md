# Database Information
Please be aware that for the site to operate fully, you must have a mySQL system set up on the same server as the website and configured with the correct database fields.

| [columnName]     |
|------------------|
| [type] (default) |
| [example]        |

# Connect.inc.php
This file is the main connection point into the database.


# Structure
Database Name: "midterm"

Num of Tables: 1

## Table 1
Name: "user"

| id           | username | passwordHash | firstName | lastName | email               | teacher |
|--------------|----------|--------------|-----------|----------|---------------------|---------|
| int(11) (AI) | text     | text         | text      | text     | text                | int(11) |
| 1            | sfloyd   | 5e52fee...   | Stephen   | Floyd    | stephen@example.com | 0       |