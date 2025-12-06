<?php
session_start();
$page_title = 'Login - Library Management System';
include 'includes/header.php';

// Get page parameter for signup/login toggle
$page = isset($_GET['page']) ? $_GET['page'] : 'login';
?>

<body>
    <!-- Login Page -->
    <div class="auth-container" id="loginPage" style="display: <?php echo $page == 'login' ? 'flex' : 'none'; ?>;">
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

            <form action="./backend/user-auth.php" method="post">
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
                Don't have an account? <a href="?page=signup">Create Account</a>
            </div>
        </div>
    </div>

    <!-- Signup Page -->
    <div class="auth-container" id="signupPage" style="display: <?php echo $page == 'signup' ? 'flex' : 'none'; ?>;">
        <div class="auth-card">
            <div class="logo">
                <i class="fas fa-book"></i>
                <h1>Library System</h1>
            </div>

            <form method="post" action="./backend/user-auth.php" onsubmit="return checkPasswords(this)">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="Enter your full name" name="full_name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter your email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" placeholder="Enter your phone number" name="phone_number" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="Enter your password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" placeholder="Confirm your password" name="password_confirm" required>
                </div>
                <button type="submit" class="btn-primary" name="register">Create Account</button>
            </form>
            <div class="auth-link">
                Already have an account? <a href="?page=login">Login</a>
            </div>
        </div>
    </div>

    <script>
        function checkPasswords(form) {
            if (form.password.value !== form.password_confirm.value) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>