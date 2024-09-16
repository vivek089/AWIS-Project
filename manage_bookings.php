<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// Handle adding a new booking
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_booking'])) {
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];
    $seats = $_POST['seats'];

    // Sanitize input
    $event_id = $conn->real_escape_string($event_id);
    $user_id = $conn->real_escape_string($user_id);
    $seats = $conn->real_escape_string($seats);

    // Insert booking into database
    $sql = "INSERT INTO bookings (event_id, user_id, seats, booked_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('iii', $event_id, $user_id, $seats);
        if ($stmt->execute()) {
            echo "<p>Booking added successfully.</p>";
        } else {
            echo "<p>Error: Could not add booking.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error: Could not prepare statement.</p>";
    }
}

// Handle updating a booking
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_booking'])) {
    $update_id = $_POST['update_id'];
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];
    $seats = $_POST['seats'];

    // Sanitize input
    $update_id = $conn->real_escape_string($update_id);
    $event_id = $conn->real_escape_string($event_id);
    $user_id = $conn->real_escape_string($user_id);
    $seats = $conn->real_escape_string($seats);

    // Update booking in database
    $sql = "UPDATE bookings SET event_id = ?, user_id = ?, seats = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('iiii', $event_id, $user_id, $seats, $update_id);
        if ($stmt->execute()) {
            echo "<p>Booking updated successfully.</p>";
        } else {
            echo "<p>Error: Could not update booking.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error: Could not prepare statement.</p>";
    }
}

// Handle deleting a booking
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_booking'])) {
    $delete_id = $_POST['delete_id'];

    // Sanitize input
    $delete_id = $conn->real_escape_string($delete_id);

    // Delete booking from database
    $sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('i', $delete_id);
        if ($stmt->execute()) {
            echo "<p>Booking deleted successfully.</p>";
        } else {
            echo "<p>Error: Could not delete booking.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error: Could not prepare statement.</p>";
    }
}

// Query to get bookings
$query = $conn->query('SELECT * FROM bookings');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
    <style>
        /* Basic styling for the bookings table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Manage Bookings</h1>
    
    <!-- Add Booking Form -->
    <h2>Add Booking</h2>
    <form method="POST" action="manage_bookings.php">
        <label for="event_id">Event ID:</label>
        <input type="number" name="event_id" id="event_id" required>
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" id="user_id" required>
        <label for="seats">Seats:</label>
        <input type="number" name="seats" id="seats" required>
        <button type="submit" name="add_booking">Add Booking</button>
    </form>
    
    <!-- Update Booking Form -->
    <h2>Update Booking</h2>
    <form method="POST" action="manage_bookings.php">
        <label for="update_id">Booking ID:</label>
        <input type="number" name="update_id" id="update_id" required>
        <label for="event_id">Event ID:</label>
        <input type="number" name="event_id" id="event_id" required>
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" id="user_id" required>
        <label for="seats">Seats:</label>
        <input type="number" name="seats" id="seats" required>
        <button type="submit" name="update_booking">Update Booking</button>
    </form>
    
    <!-- Delete Booking Form -->
    <h2>Delete Booking</h2>
    <form method="POST" action="manage_bookings.php">
        <label for="delete_id">Booking ID:</label>
        <input type="number" name="delete_id" id="delete_id" required>
        <button type="submit" name="delete_booking">Delete Booking</button>
    </form>
    
    <!-- Display Bookings Table -->
    <h2>Current Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Event ID</th>
                <th>User ID</th>
                <th>Seats</th>
                <th>Booked At</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $query->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($booking['id']); ?></td>
                    <td><?php echo htmlspecialchars($booking['event_id']); ?></td>
                    <td><?php echo htmlspecialchars($booking['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($booking['seats']); ?></td>
                    <td><?php echo htmlspecialchars($booking['booked_at']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
