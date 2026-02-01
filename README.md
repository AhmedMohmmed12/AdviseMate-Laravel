# AdviseMate - Academic Advising Management System

AdviseMate is a comprehensive web application designed to streamline the academic advising process. It bridges the gap between Students, Academic Advisors, and Supervisors, facilitating efficient appointment scheduling, issue tracking via ticketing, and student management.

## 🚀 Features

### 🎓 For Students

- **Dashboard:** Personalized overview of activities.
- **Appointment Booking:** View advisor availability and book appointments easily.
- **Ticket System:** Raise tickets for academic issues and track their status.
- **Profile Management:** Update personal information and change passwords.

### 👨‍🏫 For Advisors

- **Appointment Management:** View upcoming appointments and update their status (completed, cancelled, etc.).
- **Availability Scheduling:** Set and manage weekly availability slots for students to book.
- **Student Management:** View assigned students and their details.
- **Ticket Resolution:** View and respond to student tickets.

### 👮‍♂️ For Supervisors (Admin)

- **User Management:** Create and manage advisor accounts and permissions.
- **Student Assignment:** Assign or unassign students to specific advisors.
- **Activity Logs:** Monitor system activities and user actions.
- **Dashboard:** High-level overview of system metrics.

## 🛠 Tech Stack

- **Backend:** [Laravel](https://laravel.com) 9.x
- **Frontend:** Blade Templates, [JavaScript], [Bootstrap 5](https://getbootstrap.com/)
- **Authentication:** Laravel Sanctum & Standard Auth
- **Permissions:** Spatie Laravel Permission
- **Localization:** Mcamara Laravel Localization
- **Asset Bundling:** Vite

## ⚙️ Installation

Follow these steps to set up the project locally.

### Prerequisites

- PHP >= 8.0
- Composer
- Node.js & NPM
- MySQL or compatible database

### Steps

1. **Clone the Repository**

    ```bash
    git clone https://github.com/yourusername/AdviseMate-Laravel.git
    cd AdviseMate-Laravel
    ```

2. **Install PHP Dependencies**

    ```bash
    composer install
    ```

3. **Install Frontend Dependencies**

    ```bash
    npm install
    ```

4. **Environment Configuration**
   Copy the example environment file and configure your database details.

    ```bash
    cp .env.example .env
    ```

    Open `.env` and set your database credentials:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

6. **Run Migrations & Seeders**
   Set up the database tables and initial data.

    ```bash
    php artisan migrate --seed
    ```

7. **Build Frontend Assets**

    ```bash
    npm run build
    ```

8. **Serve the Application**
    ```bash
    php artisan serve
    ```
    The application will be available at `http://localhost:8000`.
