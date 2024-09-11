<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $upload_dir = 'uploads/';
    $image_name = basename($image['name']);
    $target_file = $upload_dir . $image_name;

    if (move_uploaded_file($image['tmp_name'], $target_file)) {
        $query = $conn->prepare('INSERT INTO gallery (image_name) VALUES (?)');
        $query->bind_param('s', $image_name);
        $query->execute();

        header('Location: manage_gallery.php');
        exit();
    } else {
        echo "Error uploading file.";
    }
}

// Display uploaded images
$query = $conn->query('SELECT * FROM gallery');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Gallery</title>
</head>
<body>
    <h1>Manage Gallery</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" required>
        <button type="submit">Upload</button>
    </form>

    <h2>Uploaded Images</h2>
    <?php
    if ($query) {
        while ($row = $query->fetch_assoc()) {
            echo "<div><img src='uploads/" . $row['image_name'] . "' width='100' height='100'><p>" . $row['image_name'] . "</p></div>";
        }
    } else {
        echo "No images found.";
    }
    ?>
</body>
</html>
