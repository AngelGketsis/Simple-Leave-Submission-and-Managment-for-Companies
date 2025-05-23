# Leave Management System

A Django-based leave management system that allows employees to submit leave requests and administrators to approve or reject them.

## Features

- User registration and authentication
- Employee dashboard to submit and view leave requests
- Admin dashboard to approve or reject leave requests
- Status tracking for leave requests (Pending, Approved, Rejected)

## Prerequisites

- Python 3.x
- MySQL database

## Installation

1. Clone the repository:

```
git clone <repository-url>
cd django-leave-project
```

2. Install the required dependencies:

```
pip install -r requirements.txt
```

3. Database Setup:

   - Create a MySQL database named `leavesystem`
   - Update the database credentials in `leave_system/settings.py` if different from default

4. Apply migrations:

```
python manage.py makemigrations
python manage.py migrate
```

5. Create a superuser (admin):

```
python manage.py createsuperuser
```

6. Run the development server:

```
python manage.py runserver
```

7. Access the application:
   - Website: http://localhost:8000
   - Admin panel: http://localhost:8000/admin

## Usage

1. Register a new account or log in with existing credentials
2. Submit new leave requests from the dashboard
3. Admins can log in and approve/reject requests from the admin dashboard

## Project Structure

- `leave_app/` - Main application directory
  - `models.py` - Database models (User, LeaveRequest)
  - `views.py` - Views for all functionality
  - `forms.py` - Forms for leave requests and user registration
  - `urls.py` - URL configurations
  - `templates/` - HTML templates
  - `admin.py` - Admin panel configuration

## License

This project is licensed under the MIT License.
