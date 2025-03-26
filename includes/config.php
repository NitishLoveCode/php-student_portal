<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'student_portal');

// Site configuration
define('SITE_URL', 'http://localhost/student-portal');
define('SITE_NAME', 'Student Portal');

// Start session
session_start();

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>