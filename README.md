# Student Management System

A simple, responsive web application built with PHP and MySQL to manage student records. The application supports adding, viewing, editing, deleting, and searching student information.

## Features

- Add new student records.
- View all registered students.
- Edit existing student information.
- Delete student records with confirmation.
- Search students by name, email, or course.
- Validate required fields and email addresses.
- Prevent duplicate email registrations.
- Display success and error messages.
- Show the total number of students.
- Responsive user interface.

## Technologies Used

- **Frontend:** HTML, CSS
- **Backend:** PHP
- **Database:** MySQL / MariaDB
- **Development Environment:** XAMPP
- **Version Control:** Git and GitHub

## Project Structure

```text
student-management-system/
│
├── index.php
├── add_student.php
├── edit_student.php
├── update_student.php
├── delete_student.php
├── db.example.php
├── style.css
├── .gitignore
└── README.md
```

## Database Setup

1. Open phpMyAdmin.
2. Create a database named `student_management`.
3. Execute the following SQL query:

```sql
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15),
    course VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Installation and Setup

1. Install [XAMPP](https://www.apachefriends.org/).
2. Clone this repository:

```bash
git clone https://github.com/fida-fei/student-management-system.git
```

3. Move the project folder into the XAMPP `htdocs` directory.
4. Create the database and table using the SQL query above.
5. Create a copy of `db.example.php` and rename it to `db.php`.
6. Update the database credentials in `db.php` according to your local environment.
7. Start Apache and MySQL/MariaDB from the XAMPP Control Panel.
8. Open the application in your browser:

```text
http://localhost/student-management-system/
```

## Learning Outcomes

Through this project, I practised:

- PHP fundamentals and server-side form