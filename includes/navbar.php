<?php
include './database/conn.php';
if (!isset($_SESSION)) {
    session_start();
}


if(isset($_GET['search'])){
    $search = $_GET['search'];
    $get_books = mysqli_query($conn,"SELECT * FROM books WHERE book_name LIKE '%$search%' OR author LIKE '%$search%' OR isbn LIKE '%$search%' OR publisher LIKE '%$search%' OR publication_year LIKE '%$search%' OR price LIKE '%$search%' OR quantity LIKE '%$search%' OR description LIKE '%$search%' OR status LIKE '%$search%'");
}
else{
   
}
?>

<div class="navbar">
    <form method="GET">
        <div class="search-bar">
            <i class="fas fa-search" style="color: #666;"></i>
            <input type="text" name="search" placeholder="Search books...">
        </div>
    </form>

    <div class="user-info">
        <div class="user-avatar">
            <?php echo isset($_SESSION['full_name']) ? strtoupper(substr($_SESSION['full_name'], 0, 1)) : 'U'; ?>
        </div>
        <div class="user-details">
            <div class="user-name"><?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'User'; ?></div>
            <div class="user-email"><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'user@example.com'; ?>
            </div>
        </div>
        <i class="fas fa-chevron-down" style="color: #666;"></i>
    </div>
</div>