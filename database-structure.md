# Dejavu Backend Database Structure

## Database Tables and Models

| Table Name | Model | File Location | Description |
|------------|-------|--------------|-------------|
| users | User | app/Models/User.php | User accounts for authentication and authorization |
| faqs | Faq | app/Models/Faq.php | Frequently asked questions |
| faq_categories | FaqCategory | app/Models/FaqCategory.php | Categories for FAQs |
| customers | Customer | app/Models/Customer.php | Customer information |
| permissions | - | - | Spatie Laravel Permission package |
| roles | - | - | Spatie Laravel Permission package |
| model_has_roles | - | - | Spatie Laravel Permission package |
| model_has_permissions | - | - | Spatie Laravel Permission package |
| role_has_permissions | - | - | Spatie Laravel Permission package |
| personal_access_tokens | - | - | Laravel Sanctum package |

## Relationships

1. **User**
   - Roles and permissions relationships via Spatie package

2. **Faq**
   - Belongs to FaqCategory (`category_id` foreign key)

3. **FaqCategory**
   - Has many Faqs (one-to-many relationship)

4. **Customer**
   - No direct relationships yet

## Important Fields and Parameters

1. **User Table**
   - `name`: User's display name
   - `email`: User's email address (unique)
   - `password`: Hashed password
   - `status`: User's status (active/inactive)

2. **Faq Table**
   - `question`: The FAQ question
   - `answer`: The FAQ answer/content
   - `category_id`: Foreign key to faq_categories table
   - `status`: FAQ status (active/inactive)
   - `order`: Display order for sorting

3. **FaqCategory Table**
   - `name`: Category name
   - `slug`: URL-friendly name
   - `status`: Category status (active/inactive)
   - `order`: Display order for sorting

4. **Customer Table**
   - `first_name`: Customer's first name
   - `last_name`: Customer's last name
   - `email`: Customer's email address (unique)
   - `phone`: Customer's phone number (optional)
   - `address`: Customer's address (optional)
   - `city`: Customer's city (optional)
   - `state`: Customer's state/province (optional)
   - `postal_code`: Customer's postal/zip code (optional)
   - `country`: Customer's country (optional)
   - `status`: Customer's status (active/inactive)
   - `notes`: Additional notes about the customer (optional)
   - Uses soft deletes (deleted_at column)

## Running the Database Setup

To fix your database connection issues and initialize the schema:

1. Run the fix-database.php script:
   ```
   php fix-database.php
   ```

2. Update your .env file to use the new database name:
   ```
   DB_DATABASE=dejavu_new
   ```

3. Clear cache after changing environment variables:
   ```
   php artisan config:clear
   ``` 