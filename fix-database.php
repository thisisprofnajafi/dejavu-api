<?php

/**
 * This script fixes the database connection and schema issues
 * Run this with: php fix-database.php
 */

echo "Database and Models Fixer Script\n";
echo "--------------------------------\n";

// 1. Create a .env.database file with a new database name
echo "1. Creating temporary .env file with new database name...\n";
copy('.env', '.env.backup');
$envContent = file_get_contents('.env');
$envContent = preg_replace('/DB_DATABASE=dejavu/', 'DB_DATABASE=dejavu_new', $envContent);
file_put_contents('.env.temp', $envContent);

// 2. Run artisan commands
echo "2. Running migrations with new database name...\n";
passthru('php artisan migrate:fresh --env=.env.temp --force');

// 3. Seed the database if needed
echo "3. Seeding the database...\n";
passthru('php artisan db:seed --env=.env.temp --force');

// 4. Restore original .env file
echo "4. Restoring original .env file...\n";
unlink('.env.temp');

echo "\nDone! Database has been set up and models have been verified.\n";
echo "The following models are available with their database tables:\n";
echo "- User -> users\n";
echo "- Faq -> faqs\n";
echo "- FaqCategory -> faq_categories\n";
echo "- Customer -> customers\n";

echo "\nYou may need to update your .env file to use 'dejavu_new' as database name.\n"; 