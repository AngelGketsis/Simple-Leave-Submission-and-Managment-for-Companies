# Leave Management System

## Project Evolution

This project has evolved through multiple iterations:

1. **Original Version**:

   - Built with basic HTML and PHP
   - Used USB server for local development
   - Basic functionality with minimal styling
   - Simple user management system

2. **Spring Boot Implementation**:

   - Modernized with Spring Boot framework
   - Enhanced security with Spring Security
   - MySQL database integration
   - Improved user interface with Thymeleaf templates

3. **Current Django Implementation**:
   - Complete rebuild using Django framework
   - Modern, responsive design with Bootstrap 5
   - Enhanced user experience and interface
   - Robust authentication and authorization system

## Features

### User Management

- User registration with email verification
- Role-based access control (Employees and Managers)
- Secure authentication system
- User profile management

### Employee Features

- Dashboard to view all leave requests
- Submit new leave requests
- Track request status (Pending, Approved, Rejected)
- View request history with filtering options

### Manager Features

- Dedicated admin dashboard
- View and manage pending leave requests
- Approve or reject requests with single click
- Overview of team members' leave status

### Technical Implementation

- **Backend**: Django 4.0+
- **Database**: MySQL
- **Frontend**: Bootstrap 5, HTML5, CSS3
- **Authentication**: Django's built-in auth system
- **Security**: CSRF protection, form validation
- **Template Engine**: Django Templates

## Setup and Installation

### Prerequisites

- Python 3.x
- MySQL Server
- pip (Python package manager)

### Database Setup

1. Create MySQL database:

```sql
CREATE DATABASE leavesystem;
```

2. Configure database in `settings.py`:

```python
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.mysql',
        'NAME': 'leavesystem',
        'USER': 'root',
        'PASSWORD': '123456',
        'HOST': 'localhost',
        'PORT': '3306',
    }
}
```

### Installation Steps

1. Clone the repository
2. Install dependencies:
   ```bash
   pip install -r requirements.txt
   ```
3. Run migrations:
   ```bash
   python manage.py makemigrations
   python manage.py migrate
   ```
4. Create admin user:
   ```bash
   python manage.py createsuperuser
   ```
5. Start development server:
   ```bash
   python manage.py runserver
   ```

## Usage Guide

### For Employees

1. Register a new account
2. Log in to access dashboard
3. Submit leave requests with start and end dates
4. Monitor request status

### For Managers

1. Access admin dashboard
2. Review pending leave requests
3. Approve or reject requests
4. View team leave history

## Future Enhancements

- Email notifications for request status changes
- Calendar integration
- Leave balance tracking
- Advanced reporting features
- Mobile-responsive design improvements
- API endpoints for mobile app integration

## Contributing

Contributions are welcome! Please feel free to submit pull requests.

## License

This project is licensed under the MIT License.
