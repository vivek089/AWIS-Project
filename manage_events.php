<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $query = $conn->prepare('INSERT INTO events (name, type, description, date) VALUES (?, ?, ?, ?)');
    $query->bind_param('ssss', $name, $type, $description, $date);
    $query->execute();

    header('Location: manage_events.php');
    exit();
}
?>

<form method="POST">
    <label for="name">Event Name:</label>
    <input type="text" name="name" id="name" required>
    <label for="type">Event Type:</label>
    <select name="type" id="type" required>
        <option value="movie">Movie</option>
        <option value="art exhibition">Art Exhibition</option>
        <option value="concert">Concert</option>
    </select>
    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>
    <label for="date">Event Date:</label>
    <input type="date" name="date" id="date" required>
    <button type="submit">Add Event</button>
</form>
