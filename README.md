# Web-Based Pharmacy Product Management System

A web-based Pharmacy Product Management System developed using **PHP** and **MySQL**. This application is designed to help pharmacies efficiently manage medicinal products, inventory, suppliers, sales transactions, and stock records through a centralized management platform.

## Overview

The Pharmacy Product Management System provides an easy-to-use interface for managing pharmacy operations. Authorized users can securely log in and perform various administrative tasks, including product management, supplier management, stock monitoring, and sales tracking.

One of the key features of the system is its automatic stock deduction functionality, which updates inventory levels whenever a product is sold.

---

## Features

### Dashboard
- Overview of system activities and statistics

### User Management
- View Admin Records
- Add New Users
- Edit User Profiles
- Update User Photos

### Category Management
- View Categories
- Add New Categories
- Delete Categories

### Supplier Management
- View Suppliers
- Add New Suppliers
- Delete Suppliers

### Product Management
- View Products
- Add New Products
- Delete Products

### Sales Management
- View Sales Records
- Create New Sales Transactions
- Delete Sales Records

### Stock Management
- View Stock Records
- Add New Stock Entries
- Delete Stock Records

### Additional Features
- Change Password
- Database Backup

---

## System Workflow

1. Users log in using their credentials.
2. Manage product categories and suppliers.
3. Add pharmacy products into the system.
4. Record stock entries when products are received.
5. Create sales transactions.
6. Product quantities are automatically deducted from stock after each sale.
7. Generate and monitor inventory and sales records.

---

## Screenshots

### Category Page
![Category Page](screenshots/category-page.png)

### Supplier Page
![Supplier Page](screenshots/supplier-page.png)

### Product Page
![Product Page](screenshots/product-page.png)

### Stock Records Page
![Stock Records Page](screenshots/stock-records-page.png)

### Sales Records Page
![Sales Records Page](screenshots/sales-records-page.png)

### Sales Form Page
![Sales Form Page](screenshots/sales-form-page.png)

> **Note:** Add actual screenshots inside the `screenshots/` directory and update the image paths accordingly.

---

## Technology Stack

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Bootstrap
- Apache (XAMPP/WAMP)

---

## Requirements

Before running the project, ensure the following software is installed:

- XAMPP or WAMP Server
- PHP 7.x or later
- MySQL/MariaDB
- Modern Web Browser

---

## Installation Guide

### 1. Clone or Download the Project

```bash
git clone https://github.com/yourusername/pharmacy-product-management-system.git
```

Or download and extract the source code ZIP file.

### 2. Move Project Folder

#### XAMPP

Copy the project folder into:

```text
C:\xampp\htdocs\
```

#### WAMP

Copy the project folder into:

```text
C:\wamp64\www\
```

### 3. Start Services

Open XAMPP/WAMP Control Panel and start:

- Apache
- MySQL

### 4. Create Database

Open:

```text
http://localhost/phpmyadmin
```

Create a new database named:

```sql
product_expiry_goodness
```

### 5. Import Database

Import the SQL file located in:

```text
db/product_expiry_goodness.sql
```

### 6. Run the Application

Open your browser and navigate to:

```text
http://localhost/product_expiry/
```

---

## Default Admin Account

| Field | Value |
|---------|---------|
| Email | newleastpaysolution@gmail.com |
| Password | escobar2012 |

> ⚠️ Change the default administrator credentials immediately after installation for security purposes.

---

## Project Structure

```text
product_expiry/
│
├── assets/
├── db/
│   └── product_expiry_goodness.sql
├── includes/
├── pages/
├── uploads/
├── index.php
└── README.md
```

---

## Security Recommendations

- Change default admin credentials.
- Use strong passwords.
- Restrict access to database backups.
- Enable HTTPS in production environments.
- Regularly back up the database.

---

## Future Enhancements

- Barcode Scanner Integration
- Expiry Date Monitoring
- Low Stock Alerts
- Sales Reports and Analytics
- Multi-User Role Management
- Audit Logs
- Email Notifications

---

## License

This project is intended for educational and learning purposes. Review and update licensing information before deploying in a production environment.

---

## Acknowledgements

This project was originally shared as a free PHP and MySQL educational resource for students, developers, and researchers interested in pharmacy management systems and inventory management applications.
