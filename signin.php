<?php include 'header.php'; ?>
<body class="login-page">
    <div class="parent-container">
        <div class="login-container">
            <h1>SIGN UP</h1>
            <form action="sign_up.php" method="post">
                <input type="text" name="username" required placeholder="Username">
                <input type="email" name="email" required placeholder="Email">
                <input type="password" name="password" required placeholder="Choose Password">
                <div class="options">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="login.php" class="create-account">Already have account</a>
                </div>
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>
    

 <?php include 'footer.php'; ?>