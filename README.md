<div align='center'>

# Event Management System 

</div>

## About

The objective of this project is to build a user-friendly, web-based event management system that enables users to create, organize, and track events, register attendees, and generate detailed event reports.

 **Key features include:**

- Implementing user login and registration with secure password hashing.
- Authenticated users can create, edit, and delete events.
-Providing an event registration form that prevents registrations beyond the maximum capacity.
- Integrating Bootstrap DataTable with search, pagination, and sorting features.
- Enabling admins to download attendee lists for specific events in CSV format.
- Maintaining client-side and server-side validation to ensure data integrity and security.
- Using prepared statements to prevent SQL injection vulnerabilities.
-Following the MVC architecture for better code organization and maintainability.

## Technology Used
- PHP - 8.1
- MySQL 
- Bootstrap - 4
- jQuery, Ajax
- phpMyAdmin
- SweetAlert2
- MVC Architecture


## How to run this project ?


#### Step-1: At first clone the repository 

For SSH

```bash
git clone git@github.com:Irfan-Chowdhury/event-management-system.git
```

Or, for HTTPS

```bash
git clone https://github.com/Irfan-Chowdhury/event-management-system.git
```

#### Step-2: Import DB
Please check the Database named `event_management.sql` with this script.

Please import this db in your phpMyAdmin

#### Step-3: DB Credentials

Please open the file from `project_root_directory/config/config.php` and update the your db credentials.

```bash
define("DB_HOST", "localhost");
define("DB_USER", "your_username");
define("DB_PASS", "your_password");
define("DB_NAME", "database_name");
```



#### Step-4: 
Open your Terminal on that project directory.

Run this command - 

```bash
cd public
```

and again run this command

```bash
php -S localhost:9999
```

####  Step-5 :  Login Credentials

- Login Page: http://localhost:9999/login
- Email: admin@gmail.com
- Password : admin123


### Site Visit
Open browser and visit that pages.

- Registration Page (http://localhost:9999/registration)

<img src="https://snipboard.io/dKZyM2.jpg">

<br>

- Login Page (http://localhost:9999/login)

<img src="https://snipboard.io/RCvHu3.jpg">

<br>

- Event Registration Form Page (http://localhost:9999/event-attendee-reg-form)

<img src="https://snipboard.io/mVj0TC.jpg">


<br>

- Admin Home Page (http://localhost:9999/home)

<img src="https://snipboard.io/Ql98pN.jpg">


<br>

- Event  Page (http://localhost:9999/events)

<img src="https://snipboard.io/JImrMn.jpg">

<br>

- Event  Create 

<img src="https://snipboard.io/vXPj28.jpg">

<br>

- Event  Edit 

<img src="https://snipboard.io/G1qjTF.jpg>


<br>

- Attendee Lists Report : (http://localhost:9999/reports)

<img src="https://snipboard.io/69xYE1.jpg">

<br>

- CSV Format

<img src="https://snipboard.io/jTGuvQ.jpg">


### Others

- Server Side Validation For Require Field : 
<img src="https://snipboard.io/MBIwbk.jpg">

<br>

- Server Side Validation For Unique Field : 
<img src="https://snipboard.io/6o7CYy.jpg">

<br>

- Client Side Validation Register: 
<img src="https://snipboard.io/jT6Fch.jpg">

<br>

- Client Side Validation Login: 
<img src="https://snipboard.io/xpmz0e.jpg">

<br>

- Client Side Validation Event Reg Form: 
<img src="https://snipboard.io/LFURaI.jpg">

<br>

- Client Side Validation For Event Event: 
<img src="https://snipboard.io/iA73gX.jpg">

<br>

- Success Message Added : 
<img src="https://snipboard.io/uG1hzf.jpg">







