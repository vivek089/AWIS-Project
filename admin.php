<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="manage_events.php">Manage Events</a>
            <a href="manage_bookings.php">Manage Bookings</a>
            <a href="manage_gallery.php">Manage Gallery</a>
            <a href="log_out.php">Logout</a>
        </nav>
    </header>
   
</body>
</html>
