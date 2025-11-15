# 📚 Library Management API (Laravel 11 + JWT + Swagger)

A RESTful Library Management System built with **Laravel 11**, **PostgreSQL**, **JWT Authentication**, **Role-Based Access Control**, and **Swagger/OpenAPI** documentation.

This API supports:

- User Authentication (Register/Login/Logout/Refresh)
- Role-based Authorization (Admin / User)
- Books Management (CRUD)
- Borrowing / Returning system
- Events & Listeners (on book return)
- Caching optimization
- Complete Swagger documentation

---

## 🚀 Features

- JWT Authentication (Login/Register/Logout)
- RBAC using Custom Middleware (`admin` access)
- CRUD operations for Books
- Borrow/Return functionality
- Event & Listener: `BookReturned`
- Swagger UI for API documentation
- Centralized Error handling (JSON responses)
- Pagination, Validation, Caching

---

# 📦 Installation & Setup

Follow the steps below to run the project locally.

---

## 1️⃣ Clone the Repository

```bash
git clone GIT_URL
cd library-api
```

---

## 2️⃣ Install Dependencies

```bash
composer install
```

---

## 3️⃣ Configure Environment (.env)

Set your PostgreSQL database credentials:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=library
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

---

## 4️⃣ Generate App Key

```bash
php artisan key:generate
```

---

## 5️⃣ Generate JWT Secret

```bash
php artisan jwt:secret
```

---

## 6️⃣ Run Migrations + Seeders

```bash
php artisan migrate --seed
```

Seeders include:

- Roles (Admin, User)
- Sample Books
- Sample Users (optional)

---

## 7️⃣ Start the Server

```bash
php artisan serve
```

Your API will now be running at:

```
http://localhost:8000
```

---

# 📘 API Documentation (Swagger)

Once the server is running, open Swagger UI:

```
http://localhost:8000/api/documentation
```

---

# 🔐 Authentication API Endpoints (JWT)

| Method | Endpoint   | Description                 |
|--------|-------------|-----------------------------|
| POST   | /register   | Register a new user         |
| POST   | /login      | Login and get JWT token     |
| POST   | /logout     | Logout user (invalidate token) |
| POST   | /refresh    | Refresh JWT token           |

---

# 🏷️ Role API Endpoints

| Method | Endpoint  | Description      |
|--------|-----------|------------------|
| GET    | /roles    | Get all roles    |

---

# 📚 Books API Endpoints

| Method | Endpoint         | Description             |
|--------|------------------|-------------------------|
| GET    | /books           | List all books          |
| GET    | /books/{id}      | Get book by ID          |
| POST   | /books           | Create book (Admin)     |
| PUT    | /books/{id}      | Update book (Admin)     |
| DELETE | /books/{id}      | Delete book (Admin)     |

---

# 📦 Borrowing API Endpoints

| Method | Endpoint                    | Description            |
|--------|------------------------------|------------------------|
| POST   | /api/{book_id}/borrow        | Borrow a book          |
| POST   | /api/{book_id}/return        | Return borrowed book   |
| GET    | /my-borrowings                  | List all borrowings    |

---

# 🏛 Project Structure

```
app/
 ├── Http/
 │    ├── Controllers/
 │    │    ├── AuthController.php
 │    │    ├── BookController.php
 │    │    ├── BorrowingController.php
 │    ├── Middleware/
 │    │    └── RoleMiddleware.php
 │
 ├── Models/
 │    ├── User.php
 │    ├── Role.php
 │    ├── Book.php
 │    └── Borrowing.php
 │
 ├── Events/
 │    └── BookReturned.php
 │
 ├── Listeners/
 │    └── SendBookReturnedNotification.php
 │
config/
database/
routes/
```

---

# 🧪 Running Automated Tests

```bash
php artisan test
```

---

# 🏗️ Architectural Decisions

- JWT Authentication for secure stateless login
- Role-Based Middleware for admin/user permissions
- Caching on book listing for performance
- Event-driven pattern for returning books
- Global JSON Error Handling
- Swagger/OpenAPI documentation

---

# 📄 License

This project is open-source and free to use.
