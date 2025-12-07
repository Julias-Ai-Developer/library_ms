<?php
include 'includes/header.php';
include './database/conn.php';
$page_title = 'Login - Library Management System';
?>

<body>
    <!-- Login Page -->
    <div class="auth-container" id="loginPage" style="display: flex;">
        <div class="auth-card">
            <div class="logo">
                <i class="fas fa-book"></i>
                <h1>Library System</h1>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div style="background: #ff4444; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div style="background: #00C851; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="./backend/login.php" method="post">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-primary" name="login">Login</button>
            </form>
            <div class="auth-link">
                Don't have an account? <a href="register.php">Create Account</a>
            </div>
        </div>
    </div>
</body>

</html>