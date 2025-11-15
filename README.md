# 📚 Library Management API (Laravel 11 + JWT)

A RESTful API built using **Laravel 11**, **PostgreSQL**, and **JWT Authentication**.  
This project provides user authentication, role management, book management, and book borrowing/return features.

---

## 🚀 Features

- JWT Authentication (Login, Register, Logout, Refresh Token)
- Role-based access (Admin / User)
- CRUD API for Books
- Borrow & Return Books
- Pagination for Books Listing
- Global error handling (JSON responses)
- Swagger/OpenAPI API Documentation

---

## 🛠️ Tech Stack

- **Laravel 11**
- **PHP 8.2+**
- **JWT (tymon/jwt-auth)**
- **PostgreSQL / MySQL**
- **Swagger (L5-Swagger)**

---

## 📦 Installation Guide

### 1️ Clone the Repository
```bash
git clone https://github.com/your-repo/library-api.git
cd library-api```

### 2 Install Dependencies
```composer install```

### 3 Install Dependencies

```DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=library
DB_USERNAME=postgres
DB_PASSWORD=your_password```


### 4 Generate App Key
```php artisan key:generate```


### 5 Configure JWT Secret
```php artisan jwt:secret```


### 6 Run Migrations + Seeders
```php artisan migrate --seed```

### 7 Start the Server
```php artisan serve```


## View Swagger UI

```/api/documentation```