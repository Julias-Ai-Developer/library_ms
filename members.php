<?php
include 'includes/header.php';
include 'database/conn.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$get_members =  mysqli_query($conn,"SELECT * FROM members");


$page_title = 'Members - Library Management System';

?>

<body>
    <div class="dashboard">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/navbar.php'; ?>

            <div class="content">
                <h1 class="page-title">Library Members</h1>
                <?php include 'includes/toasters.php' ?>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">All Members</h2>
                        <button class="btn btn-add" onclick="openModal('memberModal')"><i class="fas fa-plus"></i> Add
                            New Member</button>
                    </div>
                    <div class="member-grid">
                        
                        <?php while ($member = mysqli_fetch_assoc($get_members)): ?>

                        <div class="member-card">
                        
                            <div class="member-avatar"><?php echo $member['full_name'][0]?></div>
                            <div class="member-name"><?php echo $member['full_name'] ?></div>
                            <div class="member-email"><?php echo $member['email'] ?></div>
                            <span class="badge success">Active</span>
                        </div>
                            <?php endwhile; ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    <div class="modal" id="memberModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add New Member</h2>
                <button class="close-modal" onclick="closeModal('memberModal')">&times;</button>
            </div>
            <form method="post" action="./backend/add-members.php" >
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" placeholder="Enter full name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" placeholder="Enter phone number" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Enter address" required>
                </div>
                <div class="form-group">
                    <label>Membership Type</label>
                    <select style="width: 100%; padding: 12px; border: 2px solid #E7F7F1; border-radius: 8px;" name="membership_type" required>
                        <option value="">Select type</option>
                        <option value="student">Student</option>
                        <option value="adult">Adult</option>
                        <option value="senior">Senior</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary" name="add_member">Add Member</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        window.onclick = function (event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>

</html>