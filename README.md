# RFID Student Attendance System

A comprehensive web-based student attendance management system using RFID technology. This system allows educational institutions to track student attendance efficiently through RFID card scanning, providing real-time monitoring, detailed reports, and analytics.

## 📋 Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Configuration](#configuration)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Design & UI](#design--ui)
- [API Endpoints](#api-endpoints)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## ✨ Features

### Core Functionality
- **RFID Card Management**: Register and manage student RFID cards
- **Real-time Attendance Tracking**: Automatic attendance logging when students scan their cards
- **Student Management**: Add, update, and remove student records
- **Teacher & Section Management**: Organize students by teachers and sections
- **Attendance Dashboard**: Visual analytics with charts and statistics
- **User Logs**: Detailed attendance logs with filtering capabilities
- **Excel Export**: Export attendance data to Excel format
- **Admin Authentication**: Secure login system with password reset functionality

### Dashboard Features
- **Statistics Cards**: 
  - Total Student Logs
  - Enrolled Students
  - Present Today
  - Absent Today
- **Visual Analytics**:
  - Monthly Attendance Bar Chart
  - Daily Attendance Pie Chart
  - Yearly Attendance Trends

### Advanced Features
- **Filter & Search**: Filter logs by date, time, student, or section
- **Real-time Updates**: Auto-refresh attendance logs every 5 seconds
- **Responsive Design**: Works on desktop, tablet, and mobile devices
- **Event Calendar**: Calendar event management system

## 🛠 Technology Stack

### Backend
- **PHP 7.4+**: Server-side scripting
- **MySQL/MariaDB**: Database management
- **Apache/Nginx**: Web server

### Frontend
- **HTML5**: Markup language
- **CSS3**: Styling with custom CSS and Bootstrap
- **JavaScript**: Client-side scripting
- **jQuery 2.2.3**: DOM manipulation
- **Bootstrap 3.4/4.0**: Responsive UI framework
- **Chart.js**: Data visualization

### Libraries & Dependencies
- **PHPExcel/PhpSpreadsheet**: Excel file generation
- **TCPDF**: PDF generation
- **PHPMailer**: Email functionality
- **Font Awesome**: Icons

## 📦 System Requirements

- PHP 7.4 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Apache 2.4+ or Nginx 1.18+
- Composer (for dependency management)
- RFID Reader hardware (for physical attendance tracking)

## 🚀 Installation

### Step 1: Clone the Repository
```bash
git clone <repository-url>
cd RFID
```

### Step 2: Configure Web Server
- Place the project in your web server directory:
  - **XAMPP**: `C:\xampp\htdocs\RFID`
  - **WAMP**: `C:\wamp64\www\RFID`
  - **LAMP**: `/var/www/html/RFID`

### Step 3: Install Dependencies
```bash
composer install
```

### Step 4: Database Setup
See [Database Setup](#database-setup) section below.

### Step 5: Configure Database Connection
Edit `connectDB.php`:
```php
$servername = "localhost";
$username = "root";        // Your MySQL username
$password = "";            // Your MySQL password
$dbname = "rfidattendance";
```

## 🗄 Database Setup

### Option 1: Import SQL File
1. Open phpMyAdmin or MySQL command line
2. Create a new database named `rfidattendance`
3. Import the `rfidattendance.sql` file:
   ```sql
   mysql -u root -p rfidattendance < rfidattendance.sql
   ```
   Or use phpMyAdmin's import feature

### Option 2: Manual Setup
The database includes the following tables:
- `admin`: Administrator accounts
- `users`: Student information
- `users_logs`: Attendance logs
- `devices`: Teacher and section information
- `calendar_event_master`: Calendar events

### Default Admin Credentials
- **Email**: `admin@gmail.com`
- **Password**: `admin123` (change after first login)

## ⚙️ Configuration

### RFID Device Configuration
1. Connect your RFID reader to the system
2. Configure device settings in `devices.php`
3. Map RFID card UIDs to student records

### Email Configuration (Optional)
For password reset functionality, configure PHPMailer in the reset password script.

## 📖 Usage

### Admin Login
1. Navigate to `login.php`
2. Enter admin email and password
3. Access the dashboard

### Managing Students
1. Go to **Manage Students** page
2. Fill in student information:
   - Name
   - Student ID/LRN
   - Email (parent's email)
   - Gender
   - Section/Department
3. Click **Add User** to register a new student
4. Assign RFID card UID to the student

### Recording Attendance
1. Students scan their RFID cards at the RFID reader
2. System automatically logs:
   - Time-in (first scan)
   - Time-out (second scan)
   - Date and timestamp
   - Student information

### Viewing Reports
1. **Dashboard**: Overview of attendance statistics
2. **Student Logs**: Detailed attendance records
3. **Export to Excel**: Filter and export attendance data

### Managing Teachers & Sections
1. Navigate to **Teacher and Section** page
2. Add new teachers with their assigned sections
3. Enable/disable sections as needed

## 📁 Project Structure

```
RFID/
├── css/                      # Stylesheets
│   ├── bootstrap.css
│   ├── dashboard.css
│   ├── devices.css
│   ├── header.css
│   ├── login.css
│   ├── manageusers.css
│   ├── Users.css
│   └── userslog.css
├── js/                       # JavaScript files
│   ├── bootstrap.js
│   ├── Chart.js
│   ├── dashboard.js
│   ├── dev_config.js
│   ├── jquery-2.2.3.min.js
│   ├── manage_users.js
│   └── user_log.js
├── icons/                    # Image assets
│   ├── cvsulogo.png
│   ├── gov.png
│   └── ok_check.png
├── vendor/                   # Composer dependencies
├── PhpSpreadsheet/           # Excel library
├── PHPExcel-1.8/            # Legacy Excel library
├── ac_login.php             # Admin login handler
├── ac_update.php            # Admin account update
├── connectDB.php            # Database connection
├── dashboard.php            # Main dashboard
├── devices.php              # Teacher/Section management
├── event_fetching_script.php # Calendar events API
├── Export_Excel.php         # Excel export functionality
├── header.php               # Navigation header
├── index.php                # Student list page
├── login.php                # Login page
├── logout.php               # Logout handler
├── ManageUsers.php          # Student management
├── save_event.php           # Calendar event save
├── UsersLog.php             # Attendance logs
├── rfidattendance.sql       # Database schema
└── README.md                # This file
```

#### Login Page
```
┌─────────────────────────────────┐
│      RFID Attendance System     │
│                                 │
│  ┌───────────────────────────┐  │
│  │   Login Form (Steel Blue) │  │
│  │                           │  │
│  │  📧 Email Input          │  │
│  │  🔒 Password Input       │  │
│  │  [Login Button]           │  │
│  │                           │  │
│  │  Forgot Password?         │  │
│  └───────────────────────────┘  │
└─────────────────────────────────┘
```

#### Dashboard Layout
```
┌─────────────────────────────────────────────────────┐
│  Header: Logo | Navigation | Admin Name | Logout    │
├─────────────────────────────────────────────────────┤
│                                                     │
│  ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌────────┐  │
│  │  Logs    │ │  Enroll│ │ | Present│ │ | Absent │  │
│  │  Total   │ │  Total   │ │  Today   │ │  Today │  │
│  └──────────┘ └──────────┘ └──────────┘ └────────┘  │
│                                                     │
│  ┌──────────────────────┐  ┌──────────────────────┐ │
│  │ Monthly Attendance   │  │  Daily Attendance    │ │
│  │   [Bar Chart]        │  │    [Pie Chart]       │ │
│  └──────────────────────┘  └──────────────────────┘ │
│                                                     │
│  ┌──────────────────────────────────────────────┐   │
│  │            Yearly Attendance Trends          │   │
│  │            [Bar Chart - 12 Months]           │   │
│  └──────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────┘
```

#### Navigation Menu
- **Students**: View registered students
- **Manage Student**: Add/Edit/Remove students
- **Student Logs**: View attendance records
- **Teacher and Section**: Manage teachers and sections
- **Dashboard**: Analytics and statistics

#### Student Management Form
```
┌──────────────────────────────────────┐
│  Student Info                        │
│  ┌───────────────────────────────┐   │
│  │ Name: [_____________]         │   │
│  │ Student ID/LRN: [_______]     │   │
│  │ Email: [_____________]        │   │
│  └───────────────────────────────┘   │
│                                      │
│  Additional Info                     │
│  ┌───────────────────────────────┐   │
│  │ Section: [Dropdown ▼]         │   │
│  │ Gender: ○ Male  ○ Female      │   │
│  └───────────────────────────────┘   │
│                                      │
│  [Add User] [Update User] [Remove]   │
└──────────────────────────────────────┘
```

### Detailed Page Designs

#### 1. Login Page Design
```
╔═══════════════════════════════════════════════════════╗
║                    [Logo Image]                       ║
║              RFID Attendance System                   ║
║                                                       ║
║  ┌─────────────────────────────────────────────────┐  ║
║  │                                                 │  ║
║  │  Please, Login with the Admin E-mail and        │  ║
║  │              Password                           │  ║
║  │                                                 │  ║
║  │  ┌───────────────────────────────────────────┐  │  ║
║  │  │  Login Form (Steel Blue Background)       │  │  ║
║  │  │                                           │  │  ║
║  │  │  📧 E-mail: [________________]            │ │  ║
║  │  │  🔒 Password: [________________]          │ │  ║
║  │  │                                           │  │  ║
║  │  │  [        LOGIN        ]                  │  │  ║
║  │  │                                           │  │  ║
║  │  │  Forgot your Password? Reset it           │  │  ║
║  │  └───────────────────────────────────────────┘  │  ║
║  │                                                 │  ║
║  └─────────────────────────────────────────────────┘  ║
╚═══════════════════════════════════════════════════════╝
```

#### 2. Dashboard Design
```
╔════════════════════════════════════════════════════════════════════╗
║ [Logo] RFID Attendance  │ Students │ Manage │ Logs │ Devices │ Dash│
║────────────────────────────────────────────────────────────────────║
║                        Student Dashboard                           ║
║                                                                    ║
║  ┌──────────────┐ ┌──────────────┐ ┌──────────────┐ ┌──────────┐   ║
║  │  Info Card   │ │  Info Card │ │ |  Info Card   │ │  Card    │   ║
║  │              │ │              │ │              │ │          │   ║
║  │ Student Logs │ │ Enrolled     │ │ Present      │ │ Absent   │   ║
║  │    Total     │ │   Total      │ │   Today      │ │  Today   │   ║
║  │              │ │              │ │              │ │          │   ║
║  │     150      │ │     200      │ │     180      │ │    20    │   ║
║  └──────────────┘ └──────────────┘ └──────────────┘ └──────────┘   ║
║                                                                    ║
║  ┌────────────────────────────┐  ┌────────────────────────────┐    ║
║  │  Attendance for the Month  │  │    Attendance Today        │    ║
║  │                            │  │                            │    ║
║  │      [Bar Chart]           │  │      [Pie Chart]           │    ║
║  │                            │  │                            │    ║
║  │  Present: ████████ 120     │  │     ┌─────────┐            │    ║
║  │  Absent:  ████ 30          │  │     │ Present │            │    ║
║  └────────────────────────────┘  │     │  90%    │            │    ║
║                                   │     │ Absent  │           │    ║
║                                   │     │  10%    │           │    ║
║                                   │     └─────────┘           │    ║
║                                   └───────────────────────────┘    ║
║                                                                    ║
║  ┌────────────────────────────────────────────────────────────┐    ║
║  │           Attendance for the Year                          │    ║
║  │                                                            │    ║
║  │      [Bar Chart - 12 Months Comparison]                    │    ║
║  │                                                            │    ║
║  │  Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec           │    ║
║  │  ███ ███ ███ ███ ███ ███ ███ ███ ███ ███ ███ ███ Present   │    ║
║  │  ██  ██  ██  ██  ██  ██  ██  ██  ██  ██  ██  ██  ██  Absent│    ║
║  └────────────────────────────────────────────────────────────┘    ║
╚════════════════════════════════════════════════════════════════════╝
```

#### 3. Student Management Page
```
╔═══════════════════════════════════════════════════════════════════╗
║ [Logo] RFID Attendance  │ Students │ Manage │ Logs │ Devices │ Dash│
║───────────────────────────────────────────────────────────────────║
║          Add a new User, update information or remove             ║
║                                                                   ║
║  ┌────────────────────────────────────────────────────────────┐   ║
║  │  ╔═══════════════════════════════════════════════════════╗ │   ║
║  │  ║ ① Student Info                                        ║ │   ║
║  │  ╠═══════════════════════════════════════════════════════╣ │   ║
║  │  ║  Name: [_____________________________]                ║ │   ║
║  │  ║  Student Number/LRN: [________________]               ║ │   ║
║  │  ║  Parents Email: [_____________________]               ║ │   ║
║  │  ╚═══════════════════════════════════════════════════════╝ │   ║
║  │                                                            │   ║
║  │  ╔═══════════════════════════════════════════════════════╗ │   ║
║  │  ║ ② Additional Info                                     ║ │   ║
║  │  ╠═══════════════════════════════════════════════════════╣ │   ║
║  │  ║  User Department: [Section Dropdown ▼]                ║ │   ║
║  │  ║  Gender: ( ) Male  ( ) Female                         ║ │   ║
║  │  ╚═══════════════════════════════════════════════════════╝ │   ║
║  │                                                            │   ║
║  │  [Add User]  [Update User]  [Remove User]                  │   ║
║  └────────────────────────────────────────────────────────────┘   ║
║                                                                   ║
║  ┌────────────────────────────────────────────────────────────┐   ║
║  │  Student Table (Auto-refreshing every 5 seconds)           │   ║
║  │  ┌──────┬──────────┬────────┬──────────┬────────┬────────┐ │   ║
║  │  │ ID   │ Name     │ LRN    │ Gender   │ Card   │ Section│ │   ║
║  │  ├──────┼──────────┼────────┼──────────┼────────┼────────┤ │   ║
║  │  │ 1    │ John Doe │ 123456 │ Male     │ ABC123 │ BSIT   │ │   ║
║  │  │ 2    │ Jane Doe │ 123457 │ Female   │ DEF456 │ BSIT   │ │   ║
║  │  └──────┴──────────┴────────┴──────────┴────────┴────────┘ │   ║
║  └────────────────────────────────────────────────────────────┘   ║
╚═══════════════════════════════════════════════════════════════════╝
```

#### 4. Attendance Logs Page
```
╔═══════════════════════════════════════════════════════════════════╗
║ [Logo] RFID Attendance  │ Students │ Manage │ Logs │ Devices │ Dash│
║───────────────────────────────────────────────────────────────────║
║              Here are the Users daily logs                        ║
║                                                                   ║
║  [Log Filter/ Export to Excel]                                    ║
║                                                                   ║
║  ┌────────────────────────────────────────────────────────────┐   ║
║  │  Attendance Logs Table                                     │   ║
║  │  ┌──────┬──────────┬──────────┬──────────┬────────┬──────┐ │   ║
║  │  │ Name │ Card UID │ Time In  │ Time Out │ Date   │ Dep  │ │   ║ 
║  │  ├──────┼──────────┼──────────┼──────────┼────────┼──────┤ │   ║
║  │  │ John │ ABC123   │ 08:00 AM │ 05:00 PM │ 2024-01│ BSIT │ │   ║
║  │  │ Jane │ DEF456   │ 08:15 AM │ 05:10 PM │ 2024-01│ BSIT │ │   ║
║  │  └──────┴──────────┴──────────┴──────────┴────────┴──────┘ │   ║
║  └────────────────────────────────────────────────────────────┘   ║
║                                                                   ║
║  Filter Modal:                                                    ║
║  ┌────────────────────────────────────────────────────────────┐   ║
║  │  Filter By Date:                                           │   ║
║  │  From: [Date Picker]  To: [Date Picker]                    │   ║
║  │                                                            │   ║
║  │  Filter By Time:                                           │   ║
║  │  ( ) Time-in  ( ) Time-out                                 │   ║
║  │  From: [Time]  To: [Time]                                  │   ║
║  │                                                            │   ║
║  │  Filter By User: [Dropdown ▼]                              │   ║
║  │  Filter By Section: [Dropdown ▼]                           │   ║
║  │                                                            │   ║
║  │  [Filter]  [Export 1 Day]  [Export 30 Days]  [Cancel]      │   ║
║  └────────────────────────────────────────────────────────────┘   ║
╚═══════════════════════════════════════════════════════════════════╝
```

### Responsive Design Breakpoints

#### Desktop (≥1200px)
- Full-width layout
- Side-by-side charts
- 4-column statistics cards
- Full navigation menu visible

#### Tablet (768px - 1199px)
- Adjusted column layouts (2-3 columns)
- Stacked charts on smaller tablets
- Collapsible navigation menu
- Optimized table scrolling

#### Mobile (<768px)
- Single column layout
- Stacked statistics cards
- Full-width charts
- Hamburger menu navigation
- Touch-friendly buttons (min 44px height)
- Horizontal scrolling tables

### Animations & Transitions

#### Page Load Animations
- **Slide In Down**: 
  - Duration: `1s`
  - Easing: `ease-in-out`
  - Applied to: Page titles, headers
  
- **Slide In Right**:
  - Duration: `1s`
  - Easing: `ease-in-out`
  - Applied to: Tables, data sections

#### Interactive Animations
- **Card Hover**:
  - Transform: `translateY(-5px)`
  - Shadow enhancement: `0 10px 20px rgba(0, 0, 0, 0.2)`
  - Transition: `all 0.3s ease-in-out`

- **Button Hover**:
  - Background color change
  - Transition: `all 0.3s ease`

- **Form Toggle**:
  - Height animation: `toggle`
  - Opacity: `toggle`
  - Duration: `slow`

### Accessibility Features
- **Color Contrast**: WCAG AA compliant (minimum 4.5:1 ratio)
- **Keyboard Navigation**: All interactive elements accessible via keyboard
- **Focus Indicators**: Visible focus states on all form elements
- **Alt Text**: Images include descriptive alt text
- **ARIA Labels**: Semantic HTML with proper ARIA attributes
- **Screen Reader Support**: Proper heading hierarchy and landmarks

## 🔌 API Endpoints

### Event Management
- `event_fetching_script.php`: GET - Fetch calendar events (JSON)
- `save_event.php`: POST - Save new calendar event

### Data Endpoints
- `get_student_total.php`: GET - Get total student count
- `get_student_logs_total.php`: GET - Get total logs count
- `getdata.php`: GET - Fetch various data points

### AJAX Endpoints
- `dev_up.php`: POST - Update device/teacher information
- `manage_users_up.php`: GET - Update student list
- `user_log_up.php`: POST - Update attendance logs

## 🔧 Troubleshooting

### Common Issues

#### Database Connection Error
```
Error: Database Connection failed
```
**Solution**: 
- Check `connectDB.php` credentials
- Ensure MySQL service is running
- Verify database `rfidattendance` exists

#### Session Issues
```
Error: Session not starting
```
**Solution**:
- Ensure `session_start()` is called before any output
- Check PHP session configuration
- Clear browser cookies

#### RFID Card Not Registering
**Solution**:
- Verify RFID reader is connected
- Check card UID format
- Ensure student is registered in system

#### Excel Export Not Working
**Solution**:
- Check PHPExcel/PhpSpreadsheet installation
- Verify write permissions on server
- Check PHP memory limit

### Performance Optimization
- Enable PHP OPcache
- Use database indexing on frequently queried columns
- Implement caching for dashboard statistics
- Optimize image sizes

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards
- Follow PSR-12 PHP coding standards
- Use meaningful variable names
- Add comments for complex logic
- Test thoroughly before submitting

## 👥 Authors

- **Development Team** - Initial work

## 🙏 Acknowledgments

- Bootstrap team for the responsive framework
- Chart.js for excellent charting library
- PHPExcel/PhpSpreadsheet contributors
- All open-source library maintainers


## 🔮 Future Enhancements

- [ ] Mobile app integration
- [ ] SMS notifications for parents
- [ ] Biometric authentication
- [ ] Advanced reporting with PDF generation
- [ ] Multi-language support
- [ ] Cloud backup functionality
- [ ] API for third-party integrations
- [ ] Real-time notifications
- [ ] Automated attendance reports via email

---

**Made with ❤️ for Educational Institutions**
