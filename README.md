# Student Management System

A modern web application for managing student schedules, announcements, quizzes, and more. Built with Laravel 12 and Bootstrap.

![Dashboard Light](Picture_full_web/dashboard_white.png)

## Features

### Authentication
- User registration and login
- Secure password management
- Profile photo upload

### Dashboard
![Dashboard Dark](Picture_full_web/dashboard_dark.png)
Real-time overview with statistics and quick actions.

### Student Schedules
![Student Schedule](Picture_full_web/student_schedule.png)
Manage and view student class schedules.

### Announcements
![Announcements](Picture_full_web/announcement.png)
Create and manage school announcements.

### Question Sets & Quizzes
![Questions](Picture_full_web/question.png)
Create question sets with multiple-choice options.

### Schedule Management
![Schedule](Picture_full_web/schedule.png)
Full schedule management with CRUD operations.

### Settings
![Settings](Picture_full_web/settings.png)
User profile and password management.

## Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Blade Templates, Bootstrap 5
- **Database:** SQLite (default)
- **Build Tool:** Vite

## Installation

```bash
# Clone the repository
git clone <repository-url>
cd web-project

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start development server
composer run dev
```

## Available Routes

| Method | Route | Description |
|--------|-------|-------------|
| GET | `/login` | Login page |
| GET | `/register` | Registration page |
| GET | `/dashboard` | Main dashboard |
| GET | `/schedule` | Schedule management |
| GET | `/student-schedule` | Student schedules |
| GET | `/announcement` | Announcements |
| GET | `/questions` | Question sets |
| GET | `/settings` | User settings |

## License

MIT License
