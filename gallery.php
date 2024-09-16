<?php
include 'config.php'; // Include your database connection configuration
include 'header.php'; // Include the header

// Fetch images from the database
$sql = "SELECT image_name, image_path FROM images";
$result = $conn->query($sql);
?>

<div class="gallery-container">
    <?php
    if ($result->num_rows > 0) {
        // Output each image
        while ($row = $result->fetch_assoc()) {
            echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['image_name']) . '">';
        }
    } else {
        echo "No images found.";
    }
    ?>
</div>

<!-- Upload Form -->
<div class="upload-form">
    <h2>Upload New Image</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <input type="submit" value="Upload">
    </form>
</div>

<?php
include 'footer.php'; // Include the footer
$conn->close();
?>
