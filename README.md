# Daily Task Management System
## Overview:
This project implements a simple daily task management system that allows users to add, edit, and delete tasks through a user interface built using Blade. Additionally, it includes an automated function to send daily emails containing pending tasks using a Cron Job.

## Features
- **User Management**: Users can register and log in to the system.
- **Task Management**: 
  - View a list of daily tasks.
  - Add new tasks.
  - Edit existing tasks.
  - Delete tasks.
  - Change task status between "Pending" and "Completed".
- **Daily Email Notifications**: Users receive daily emails with their pending tasks.
## Requirements

### Models
1. **Task**
   - Fields: `title`, `description`, `due_date`, `status` (Pending, Completed)
2. **User**
   - Fields: `name`, `email`, `password`
### Blade Templates
- A simple UI design using Blade directives:
  - `@if`, `@foreach`, and `@csrf` for handling conditional rendering and form submissions.

### Command
- A command created using Laravel's Artisan that runs via a Cron Job to send daily emails to each user with their pending tasks.

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/salha200/daily-task-management.git
   cd daily-task-management
2. **Install dependencies**:
composer install
3. **Set up the environment**:
Copy the .env.example file to .env and configure your database settings:
cp .env.example .env
php artisan key:generate
4. **Run migrations**:
php artisan migrate
## Testing the Email Functionality:
###To test the email functionality, you can manually run the command:
php artisan tasks:send-pending-emails

## Error Handling
The application includes error handling to ensure a smooth user experience. Errors are logged for troubleshooting.


