<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'config.php'; // Include database configuration file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];

    $sql = "INSERT INTO contact_messages (full_name, email, phone, description) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $fullName, $email, $phone, $description);
        if ($stmt->execute()) {
            echo "Message sent successfully.";
        } else {
            echo "Something went wrong. Please try again later.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Response</title>
    <link href="style.css" rel="stylesheet" />
    <style>
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Your name is: <?php echo htmlspecialchars($_POST['fullName']); ?></h1>
    <h1>Your email address is: <?php echo htmlspecialchars($_POST['email']); ?></h1>
    <h1>Your phone number is: <?php echo htmlspecialchars($_POST['phone']); ?></h1>
    <h1>Your description is: <?php echo htmlspecialchars($_POST['description']); ?></h1>
</body>
</html>
