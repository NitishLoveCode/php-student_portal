# Student Exam Portal System

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.2+-7952B3?logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

A complete web-based examination system that allows students to register, login, take exams, and view their results.

## ✨ Features

- 🛡️ **Secure Authentication**: Student registration and login system with password hashing
- 📝 **Online Exams**: Multiple-choice question interface with timer
- ⏱️ **Timed Tests**: Automatic submission when time expires
- 📊 **Instant Results**: Immediate scoring with percentage calculation
- 📈 **Performance Tracking**: View historical exam results
- 📱 **Responsive Design**: Works on desktop, tablet, and mobile devices

## 🚀 Getting Started

### Prerequisites
- Web server (Apache/Nginx)
- PHP 8.0+
- MySQL 5.7+
- Composer (for dependency management)

### Installation

**Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/student-exam-portal.git
   cd student-exam-portal


student-exam-portal/
├── assets/               # Static assets
│   ├── css/             # Stylesheets
│   └── js/              # JavaScript files
├── auth/                # Authentication
│   ├── login.php        # Login handler
│   ├── register.php     # Registration
│   └── logout.php       # Logout handler
├── exams/               # Exam functionality
│   ├── take_exam.php    # Exam interface
│   └── submit_exam.php  # Exam submission
├── includes/            # Core system files
│   ├── config.php       # Configuration
│   ├── db.php           # Database connection
│   ├── functions.php    # Helper functions
│   ├── header.php       # Header template
│   └── footer.php       # Footer template
├── results/             # Results viewing
│   └── view_results.php # Results interface
├── .env.example         # Environment config
├── index.php            # Main dashboard
└── README.md            # This file
   
