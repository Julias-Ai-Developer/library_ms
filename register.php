<?php
include './database/conn.php';
include 'includes/header.php';
$page_title = 'Register - Library Management System';
?>

<body>
    <!-- Signup Page -->
    <div class="auth-container" id="signupPage" style="display: flex;">
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

            <form method="post" action="./backend/auth-register.php" onsubmit="return checkPasswords(this)">
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
                Already have an account? <a href="login.php">Login</a>
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