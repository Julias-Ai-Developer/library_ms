<?php
include 'includes/header.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$page_title = 'Members - Library Management System';
?>

<body>
    <div class="dashboard">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/navbar.php'; ?>

            <div class="content">
                <h1 class="page-title">Library Members</h1>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">All Members</h2>
                        <button class="btn btn-add" onclick="openModal('memberModal')"><i class="fas fa-plus"></i> Add
                            New Member</button>
                    </div>
                    <div class="member-grid">
                        <div class="member-card">
                            <div class="member-avatar">JS</div>
                            <div class="member-name">John Smith</div>
                            <div class="member-email">john.smith@email.com</div>
                            <span class="badge success">Active</span>
                        </div>
                        <div class="member-card">
                            <div class="member-avatar">EJ</div>
                            <div class="member-name">Emily Johnson</div>
                            <div class="member-email">emily.j@email.com</div>
                            <span class="badge success">Active</span>
                        </div>
                        <div class="member-card">
                            <div class="member-avatar">MB</div>
                            <div class="member-name">Michael Brown</div>
                            <div class="member-email">m.brown@email.com</div>
                            <span class="badge success">Active</span>
                        </div>
                        <div class="member-card">
                            <div class="member-avatar">SD</div>
                            <div class="member-name">Sarah Davis</div>
                            <div class="member-email">sarah.d@email.com</div>
                            <span class="badge success">Active</span>
                        </div>
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
            <form onsubmit="addMember(event)">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="Enter full name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" placeholder="Enter phone number" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" placeholder="Enter address" required>
                </div>
                <div class="form-group">
                    <label>Membership Type</label>
                    <select style="width: 100%; padding: 12px; border: 2px solid #E7F7F1; border-radius: 8px;" required>
                        <option value="">Select type</option>
                        <option value="student">Student</option>
                        <option value="adult">Adult</option>
                        <option value="senior">Senior</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary">Add Member</button>
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

        function addMember(e) {
            e.preventDefault();
            closeModal('memberModal');
            alert('Member added successfully!');
        }

        window.onclick = function (event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>

</html>