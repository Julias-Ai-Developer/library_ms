<div class="sidebar">
    <div class="sidebar-logo">
        <h2><i class="fas fa-book"></i> Library</h2>
    </div>
    <ul class="sidebar-menu">
        <li><a href="dashboard.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>"><i
                    class="fas fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="books.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'books.php' ? 'active' : ''; ?>"><i
                    class="fas fa-book"></i> <span>Books</span></a></li>
        <li><a href="borrowed-books.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'borrowed-books.php' ? 'active' : ''; ?>"><i
                    class="fas fa-bookmark"></i> <span>Borrowed Books</span></a></li>
        <li><a href="members.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'members.php' ? 'active' : ''; ?>"><i
                    class="fas fa-users"></i> <span>Members</span></a></li>
        <li><a href="settings.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>"><i
                    class="fas fa-cog"></i> <span>Settings</span></a></li>
        <li><a href="backend/logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
    </ul>
</div>