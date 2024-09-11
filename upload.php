<?php
include 'config.php'; // Include your database connection configuration

// Check if an image was uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    // Define allowed file extensions
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    
    if (in_array($fileExtension, $allowedExtensions)) {
        // Define the upload directory
        $uploadFileDir = './uploaded_images/';
        $dest_path = $uploadFileDir . $fileName;
        
        // Create the directory if it doesn't exist
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }
        
        // Move the file to the upload directory
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Insert file info into the database
            $stmt = $conn->prepare("INSERT INTO images (image_name, image_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $fileName, $dest_path);
            
            if ($stmt->execute()) {
                header("Location: gallery.php"); // Redirect to gallery page
                exit();
            } else {
                echo "Database insert failed: " . $conn->error;
            }
            $stmt->close();
        } else {
            echo "Error moving the file.";
        }
    } else {
        echo "Upload failed. Allowed file types: " . implode(", ", $allowedExtensions);
    }
} else {
    echo "No file uploaded or there was an upload error: " . $_FILES['image']['error'];
}

$conn->close();
?>
