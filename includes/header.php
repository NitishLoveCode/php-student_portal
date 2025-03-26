<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' | ' . SITE_NAME : SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="<?php echo SITE_URL; ?>"><?php echo SITE_NAME; ?></a></h1>
            <nav>
                <?php if (isLoggedIn()): ?>
                    <a href="<?php echo SITE_URL; ?>">Dashboard</a>
                    <a href="<?php echo SITE_URL; ?>/exams/take_exam.php">Exams</a>
                    <a href="<?php echo SITE_URL; ?>/results/view_results.php">Results</a>
                    <a href="<?php echo SITE_URL; ?>/auth/logout.php">Logout</a>
                <?php else: ?>
                    <a href="<?php echo SITE_URL; ?>/auth/login.php">Login</a>
                    <a href="<?php echo SITE_URL; ?>/auth/register.php">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container">