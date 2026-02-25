Money Tracker API

Backend Assessment – Laravel

Project Overview

This project is a backend-only Money Tracker API built using Laravel. The system allows users to manage multiple wallets and track income and expense transactions. The API is designed to be consumed by an external frontend application.

The application supports:

Creating user accounts

Creating multiple wallets per user

Adding income and expense transactions

Viewing wallet balances

Viewing total balance across all wallets

Viewing transaction history for a wallet

This implementation satisfies all functional and technical requirements of the assessment.

Development Stages
1. Project Setup

Installed Laravel using Composer

Configured environment variables

Connected the application to MySQL

Enabled API routing (Laravel 12 configuration)

2. Database Design and Migrations

Three main tables were created:

Users Table

id

name

email

password

timestamps

Wallets Table

id

user_id (foreign key)

name

timestamps

Transactions Table

id

wallet_id (foreign key)

type (income or expense)

amount

description (nullable)

timestamps

Relationships

A User has many Wallets

A Wallet belongs to a User

A Wallet has many Transactions

A Transaction belongs to a Wallet

Foreign keys use cascade delete to maintain referential integrity.

3. Model Layer

Each model includes:

Proper $fillable properties to protect against mass assignment

Eloquent relationships

Clean structure and separation of responsibilities

Wallet balance is calculated dynamically using an accessor method. The balance is derived from transactions:

Income adds to the balance

Expense subtracts from the balance

Balances are not stored in the database to avoid redundancy and ensure consistency.

4. Controllers

Three API controllers were implemented:

UserController

WalletController

TransactionController

Each controller includes:

Store methods for creating resources

Show methods for retrieving resource details

Validation logic

Structured JSON responses

5. Validation

Validation rules ensure data integrity.

User:

Name is required

Email is required and unique

Password is required and must meet minimum length

Wallet:

user_id must exist

Name is required

Transaction:

wallet_id must exist

Type must be either income or expense

Amount must be numeric and positive

Description is optional

API Routes

All routes are defined in routes/api.php.

Method	Endpoint	Description
POST	/api/users	Create a user
GET	/api/users/{id}	View user profile
POST	/api/wallets	Create a wallet
GET	/api/wallets/{id}	View wallet details
POST	/api/transactions	Add a transaction
Business Logic Implementation
Viewing a User Profile

Returns:

All wallets belonging to the user

Each wallet’s calculated balance

Total balance across all wallets

Viewing a Wallet

Returns:

Wallet balance

All transactions for that wallet

Balance calculations are performed dynamically from transaction records.

How to Run the Project
1. Clone Repository
git clone <repository-link>
cd money-tracker-api
2. Install Dependencies
composer install
3. Configure Environment

Copy .env.example to .env and update database credentials:

DB_DATABASE=money_tracker
DB_USERNAME=root
DB_PASSWORD=yourpassword
4. Generate Application Key
php artisan key:generate
5. Run Migrations
php artisan migrate
6. Start Development Server
php artisan serve

Application will run at:

http://127.0.0.1:8000
Testing the API

Use Thunder Client, Postman, or curl.

Example request to create a user:

POST /api/users

{
  "name": "Dorwin",
  "email": "dorwin@example.com",
  "password": "password123"
}
Design Decisions

Dynamic Balance Calculation
Balances are computed from transactions rather than stored. This ensures consistency and prevents data duplication.

Strong Validation
Validation prevents negative amounts, invalid transaction types, and invalid foreign keys.

Clean Architecture

Models handle relationships

Controllers handle business logic

Routes define access points

RESTful API Structure
The API follows REST principles and clear resource-based routing.

Possible Improvements

If extended further, the following enhancements could be implemented:

Authentication using Laravel Sanctum or JWT

Pagination for transactions

API Resource classes for response formatting

Automated feature tests

Soft deletes

Rate limiting

Requirements Coverage

Create user account

Create multiple wallets

Add income transactions

Add expense transactions

Calculate wallet balance

Calculate total user balance

View wallet transactions

Proper database relationships

Input validation

Structured commit history

Conclusion

This Money Tracker API meets all functional and technical requirements of the assessment. The implementation demonstrates:

Proper use of Laravel architecture

Correct use of Eloquent relationships

Clean API design

Data validation best practices

Structured and maintainable code
