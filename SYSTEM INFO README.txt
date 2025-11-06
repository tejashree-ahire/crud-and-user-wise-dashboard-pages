## User & Admin Management System

## 📘 Overview

Example of a simple yet secure user management system built with **CodeIgniter 4**.
It demonstrates full-stack CRUD operations with **authentication**, **role-based access**, and **security best practices** such as CSRF protection and AuthGuards.


There are two types of users in this system:

1. **Admin**
2. **Client**

### 📝 Registration

* New users must first register using the registration form.
* Upon successful registration, users are redirected to the login page.

### 🔐 Login

* Users can log in with their **email** and **password**.
* The system checks the **customer_type** to determine user type:

  * **Admin** → Redirected to **Admin Dashboard**
  * **Client** → Redirected to **User Dashboard**

---

## 🧑‍💼 Client Dashboard

After login, **clients** are redirected to their **dashboard** page where they can:

* View their personal and policy-related details.
* Update editable fields using the **Edit Profile** button.
* Logout securely using the **Logout** button.

All user data is retrieved using **LEFT JOIN** queries across multiple related tables (e.g., client, bill, gic, lic, goal, thought).

---

## 🧰 Admin Dashboard

Admins are redirected to a **dashboard** displaying a list of all **clients** only.

Features:

* View all client records.
* Delete client entries (soft delete only — data is not permanently removed).

* On delete, the `active_status` field changes from **1 → 0**.
* Admin-only access is protected using **AuthGuard**.

---

## 🧱 Security Features

1. **CSRF Token** → Applied to registration and login forms to prevent CSRF attacks.
2. **AuthGuard Filter** → Protects routes to ensure only logged-in users can access dashboards.
3. **Session Management** → Maintains user state securely during the session.

---

## 🔌 API Testing (Postman)

The system includes **CRUD APIs** for the `client` table to test functionality in Postman.
---

## ⚙️ Technical Details

| Feature     | Description                      |
| ----------- | -------------------------------- |
| Framework   | CodeIgniter 4                    |
| Language    | PHP 8.2+                         |
| Database    | MySQL                            |
| Security    | CSRF, AuthGuard, Session         |
| UI          | Bootstrap 5                      |
| API Testing | Postman                          |
| Query Type  | LEFT JOIN for combined data view |

---

## 🔒 AuthGuard Configuration

* Implemented in `app/Filters/AuthGuard.php`
* Checks if the user session (`isLoggedIn`) is active.
* Redirects unauthenticated users to `/login`.


## ✅ Summary

This project serves as a **complete authentication and user management system** in CodeIgniter 4, integrating:

* Secure registration and login
* Role-based dashboards
* Admin management tools
* Modern PHP practices and data handling

---

## 👩‍💻 Login Credentials
admin  : admin@gmail.com /12345
client : alice@example.com/ 12345
