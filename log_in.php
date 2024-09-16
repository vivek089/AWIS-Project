<?php
session_start();
require_once "config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Select the user and their role
    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $username, $hashed_password, $role);
            if ($stmt->fetch()) {
                if (password_verify($password, $hashed_password)) {
                    // Check if the user is an admin
                    if ($role === 'admin') {
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        $_SESSION["role"] = $role;
                        header("Location: admin.php"); // Redirect to admin dashboard
                    } else {
                        echo "You do not have permission to access this page.";
                    }
                } else {
                    echo "Invalid password.";
                }
            }
        } else {
            echo "No account found with that username.";
        }
        $stmt->close();
    }
    $conn->close();
}
if ($role === 'admin') {
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username;
    $_SESSION["role"] = $role;
    header("Location: admin.php");
    exit();
}

?>

<!-- HTML for login form -->
<form method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Login</button>
</form>
