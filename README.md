# School Management System

This is a Laravel-based School Management System API

## Features Implemented

The project implements all the requirements specified in the interview task:

1.  **Multi-Guard Authentication:** Secure API endpoints are provided for both `students` and `admins` using Laravel Sanctum.
2.  **Student & Teacher Management:** Models, migrations, and factories are created for `Student` and `Teacher` entities, with seeded data for testing.
3.  **API Endpoints:** A RESTful API is available for user authentication, including `login`, `logout`, and fetching the authenticated user's details.
4.  **Student Data Management:** Functionality to import bulk student data from a CSV/Excel file and export all student data to an Excel file is implemented.
5.  **Custom Artisan Command:** A custom command `reminders:exam` is created to send Markdown email reminders to all students about an upcoming exam.


## Docker instruction
## Getting Started with Docker

### Prerequisites

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/)

### Quick Start

#### 1. Build and Run Containers

From the project root, run the following command to build and start all necessary services:

```bash
docker-compose up -d --build
```

#### 2. Initial Setup

Prepare the application by running these commands:

```bash
# Generate application key
docker-compose exec app php artisan key:generate

# Run migrations and seed the database with students and admins
docker-compose exec app php artisan migrate:fresh --seed
```

### Usage & Testing

- **Application URL:** [http://localhost:8080](http://localhost:8080)
- **Mailpit Web UI:** [http://localhost:8025](http://localhost:8025) (View all sent emails here)

You can test the API endpoints using a tool like [Postman](https://www.postman.com/).  
The default password for all seeded users is `password`.

#### Running the Email Reminder Command

To send exam reminder emails, run:

```bash
docker-compose exec app php artisan reminders:exam "2025-08-15" "Exam Topic Reminder"
```


## Local Instruction

### Prerequisites

-   PHP >= 8.1
-   Composer
-   MySQL or another database server

### Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/tanvirprince/student-management-api.git
    cd student-management-api
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Configure the environment file:**
    Duplicate the `.env.example` file and rename it to `.env`.
    ```bash
    cp .env.example .env
    ```
    Update the database credentials and mail settings in your `.env` file. For local development, it is recommended to use the `log` driver for emails.
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=school_management
    DB_USERNAME=root
    DB_PASSWORD=

    # just for testing
    MAIL_MAILER=log
    ```

4.  **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Run migrations and seed the database:**
    This command will create the necessary tables and populate them with 200 student and 20 admin records.
    ```bash
    php artisan migrate:fresh --seed
    ```

## Usage

### API Endpoints

-   **Login:** `POST /api/login`
    -   Body: `{ "email": "...", "password": "...", "guard": "admin" }` or `{ "guard": "student" }`
-   **Logout:** `POST /api/logout` (requires `Authorization: Bearer <token>`)
-   **Fetch User:** `GET /api/user` (requires `Authorization: Bearer <token>`)

### Artisan Commands

-   **Send Exam Reminders:**
    To send the reminder email for the upcoming exam:
    ```bash
    php artisan reminders:exam "2025-08-15" "Exam Topic Reminder"
    ```
    > **Note:** The emails will be logged to `storage/logs/laravel.log` if you are using the `log` mail driver. or you can use gmail, mail trap

### Student Data Management

-   **Export Students:**
    A GET request to `/students/export` will trigger the download of an `xlsx` file with all student data.
-   **Import Students:**
    A POST request to `/students/import` with a file (`csv` or `xlsx`) will import new student records.


---

_This project was created as a submission for the Laravel Developer interview task._
