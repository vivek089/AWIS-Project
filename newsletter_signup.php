<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database configuration file
include 'config.php'; // Ensure this file sets up $conn as the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Output the posted data to verify form submission
    var_dump($_POST); // Output the posted data
    
    // Get and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Check if the email already exists
    $check_sql = "SELECT email FROM newsletter_subscribers WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    if ($check_stmt) {
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            // Email already exists
            echo "This email address is already subscribed.";
        } else {
            // Prepare an SQL statement to insert the data
            $sql = "INSERT INTO newsletter_subscribers (name, email) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ss", $name, $email);

                // Execute the query
                if ($stmt->execute()) {
                    echo "Thank you for signing up for our newsletter!";
                } else {
                    echo "Error executing query: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error preparing the SQL statement: " . $conn->error;
            }
        }

        // Close the check statement
        $check_stmt->close();
    } else {
        echo "Error preparing the check statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
