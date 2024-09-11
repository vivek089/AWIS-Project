<?php include 'header.php'; ?>
    <body class="login-page">
    <div class="parent-container">
        <div class="login-container">
            <h1>LOG IN</h1>
            <form action="log_in.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="options">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="signin.php" class="create-account">Create new Account</a>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    

<?php include 'footer.php'; ?>