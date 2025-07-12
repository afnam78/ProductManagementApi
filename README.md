# Product Management System (Laravel CRUD Demo)

---

## 🚀 Overview

This project is a simple Product Management System built with Laravel, demonstrating core CRUD (Create, Read, Update, Delete) functionalities. It serves as a showcase of my abilities in developing web applications using the Laravel framework, including database interaction, routing, controllers, and views.

## ✨ Features

* **Create Products:** Add new product entries to the database with details like name, description, and price.
* **View Products:** Display a list of all existing products.
* **Edit Products:** Modify the details of existing products.
* **Delete Products:** Remove products from the system.

## 🛠️ Technologies Used

* **Laravel 12: The PHP framework for web artisans.
* **PHP 8.2: The server-side scripting language.
* **MySQL: The database system used to store product information.
* **Sanctum: The API authentication system for securing API routes.

## 📋 Installation and Setup

Follow these steps to get the project up and running on your local machine:

1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/afnam78/ProductManagementApi.git
    cd ProductManagementApi
    ```

2.  **Install Composer Dependencies:**
    ```bash
    composer install
    ```

3.  **Create a Copy of the `.env` File:**
    ```bash
    cp .env.example .env
    ```

4.  **Generate an Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Configure Your Database:**
    Open the `.env` file and update the following database credentials:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=[your_database_name]
    DB_USERNAME=[your_database_username]
    DB_PASSWORD=[your_database_password]
    ```

6.  **Run Database Migrations:**
    This will create the necessary `products` table in your database.
    ```bash
    php artisan migrate
    ```

7.  **Serve the Application:**
    ```bash
    php artisan serve
    ```
    You can now access the application in your web browser at `http://127.0.0.1:8000`.

