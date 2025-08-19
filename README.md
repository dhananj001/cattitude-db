# Cattitude DB 🐾

This repository contains the database application built for **Cattitude.inc** — a dedicated system designed to manage customer and staff data efficiently.

> 📁 This project focuses solely on database structure and record management using modern UI and role-based access control (RBAC).

---

## Features

* ✅ Clean and intuitive layout designed to match Cattitude’s theme and branding
* 📄 **Records Page** with:

  * Search bar
  * Data table with columns:

    * `First Name`, `Last Name`, `City`, `State`, `ZIP`, `Phone`, `Email`, `Charged`, `Added By`, `Date`, `Actions`
  * “Add Record” form aligned with the Cattitude brand style
* 👥 **Staff Section** with **RBAC (Role-Based Access Control)**

  * **Admin**:

    * Full access to Records and Staff pages
    * Can assign roles
    * Can delete, edit, and add
  * **Staff**:

    * Access only to Records page
    * Can **add** and **edit** records
    * Cannot delete or access staff section

---

## 🖼️ Screenshots

<p align="center">
  <img src="https://github.com/user-attachments/assets/9f769e25-39f3-4458-baae-a9c71ad403b5" alt="Dashboard Screenshot" width="800"/>
</p>

<p align="center">
  <img src="https://github.com/user-attachments/assets/83a09afd-44fc-4457-9e94-d1ceeb69769c" width="800"/>
</p>

<p align="center">
  <img src="https://github.com/user-attachments/assets/623fcf1c-a0eb-48fc-864e-7d8ebb973c13" width="800"/>
</p>

<p align="center">
  <img src="https://github.com/user-attachments/assets/62b4c8d9-5de9-4144-be00-f070e9a9b7f6" width="800"/>
</p>

<p align="center">
  <img src="https://github.com/user-attachments/assets/81af5a9f-6f20-43ec-bbc0-b76f1e9269d2" width="800"/>
</p>

---

## Tech Stack

* ✅ **Backend**: Laravel 12
* ✅ **Database**: MySQL
* ✅ **Frontend**: TailwindCSS
* ✅ **Auth**: Role-based authorization system (RBAC)

---

## 📂 Folder Structure

```
cattitude-db/
├── public/
├── resources/
│   └── views/
├── routes/
│   └── web.php
├── app/
│   ├── Models/
│   ├── Http/
│   │   └── Controllers/
├── database/
│   └── migrations/
└── ...
```

---

## Setup Instructions

```bash
git clone https://github.com/dhananj001/cattitude-db
cd cattitude-db
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Make sure to configure your MySQL database credentials in `.env`.

---

## Acknowledgements

This system was built specifically for **Cattitude.inc** to help streamline their operations and manage records efficiently.

---

## Contact

For queries or collaboration, feel free to reach out:

**Dhananjay Borse**
[GitHub](https://github.com/dhananj001)

---
