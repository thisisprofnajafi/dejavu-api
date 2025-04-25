# Database Seeders

This directory contains seeders for populating the database with initial data.

## Available Seeders

- **RoleDatabaseSeeder**: Creates default roles and permissions
- **UserSeeder**: Creates default users with appropriate roles
- **CategorySeeder**: Creates content categories
- **SupportSeeder**: Creates support departments, FAQs, and tickets
- **ContentSeeder**: Creates sample content posts and tags

## Default Users

The following default users are created with the specified roles:

| Email               | Password  | Role    |
|---------------------|-----------|---------|
| admin@example.com   | Admin@123 | admin   |
| author@example.com  | Author@123| author  |
| visitor@example.com | Visitor@123 | visitor |

## Running the Seeders

To run all seeders:

```bash
php artisan db:seed
```

To run a specific seeder:

```bash
php artisan db:seed --class=Database\\Seeders\\UserSeeder
```

## Verifying the Seeders

A verification script is provided to check if the users and roles were created correctly:

```bash
php verify-users.php
```

## Notes

- When running the seeders multiple times, the seeders will not create duplicate data as they use `firstOrCreate`.
- The Support module migrations use uppercase 'Migrations' directory, so they need to be migrated separately:

```bash
php artisan migrate --path=Modules/Support/database/Migrations
``` 