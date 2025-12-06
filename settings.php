<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$page_title = 'Settings - Library Management System';
include 'includes/header.php';
?>

<body>
    <div class="dashboard">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/navbar.php'; ?>

            <div class="content">
                <h1 class="page-title">Settings</h1>

                <div class="card">
                    <h2 class="card-title">Account Settings</h2>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text"
                            value="<?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''; ?>"
                            style="width: 100%; padding: 12px; border: 2px solid #E7F7F1; border-radius: 8px;">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"
                            style="width: 100%; padding: 12px; border: 2px solid #E7F7F1; border-radius: 8px;">
                    </div>
                    <button class="btn btn-add" style="margin-top: 20px;">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>