# Campus Voting App (UCSTT Fresher Welcome)

A secure, real-time web application built with the Laravel framework to manage and tally votes during the University of Computer Studies, Thaton (UCSTT) Fresher Welcome King & Queen selection.

## ☁️ Production & Cloud Deployment
This system was successfully deployed online using **AWS (Amazon Web Services)** to handle live, concurrent vote casting from the student body during the actual campus event. It successfully managed real-time traffic and data processing under live production conditions.

## 🛠️ Tech Stack
* **Framework:** PHP (Laravel)
* **Database:** MySQL / MariaDB
* **Frontend:** HTML, CSS, JavaScript

## 📊 Database Structure & Rules
The application relies on a structured relational database schema (`voting.sql`) designed for high data integrity:
* **`users`**: Manages authorized student voters using secure, unique `login_code` credentials. It tracks voting status via flags (`kflag`, `qflag`) and timestamps (`kvoting_time`, `qvoting_time`) to strictly enforce a one-time-only voting policy.
* **`selection`**: Contains rich contestant profile data including names, hometowns, zodiac signs, hobbies, and physical attributes.
* **`images`**: Handles relational mapping for multiple contestant profile photos (`Images/Selections/`).
* **`vote`**: Tracks live, dynamic vote tallies linked directly to contestant IDs.
* **`cache` & `sessions`**: Laravel-backed tables utilized to handle concurrent session traffic smoothly during the peak voting hours.

## 🚀 Local Installation Guide

### 1. Prerequisites
* **XAMPP** (with PHP 8.2+ and MySQL)
* **Composer** (installed globally on your machine)

### 2. Database Setup
1. Open XAMPP and start **Apache** and **MySQL**.
2. Go to **phpMyAdmin** (`http://localhost/phpmyadmin`) and create a new database named `voting`.
3. Select your new `voting` database, go to the **Import** tab, choose the `voting.sql` file from this project, and click **Import**.

### 3. Application Setup
1. Open your terminal inside the project root directory.
2. Install the framework dependencies:
   ```bash
   composer install

4. Create your environment configuration file:
copy .env.example .env

5.Configure your database connection inside the .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=voting
DB_USERNAME=root
DB_PASSWORD=

Generate your application encryption key:
php artisan key:generate

Running the App Locally
php artisan serve

[http://127.0.0.1:8000](http://127.0.0.1:8000)