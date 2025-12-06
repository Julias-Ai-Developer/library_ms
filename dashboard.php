<?php
include 'database/conn.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
$get_books = mysqli_query($conn, "SELECT * FROM books");

$count_all_books = mysqli_fetch_assoc(mysqli_query($conn,"SELECT count(*) as total FROM books"));
while($row = ($count_all_books) ) {
    $count = $row['total'];
}

if($count == 0) {
    $count = 0;
    $available_books = 0;
    $borrowed_books = 0;
    $members = 0;
} else {
    $available_books = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM books WHERE status='available'"));
    $borrowed_books = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM books WHERE status='borrowed'"));
    $members = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
}

$page_title = 'Dashboard - Library Management System';
include 'includes/header.php';



?>

<body>
    <div class="dashboard">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/navbar.php'; ?>

            <div class="content">
                <h1 class="page-title">Dashboard</h1>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $count; ?></h3>
                            <p>Total Books</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon light-green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $available_books; ?></h3>
                            <p>Available Books</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon accent">
                            <i class="fas fa-bookmark"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $borrowed_books; ?></h3>
                            <p>Borrowed Books</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon dark">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>428</h3>
                            <p>Members</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Recent Books</h2>
                        <button class="btn btn-add"><i class="fas fa-plus"></i> Add Book</button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Publisher</th>
                                <th>Publication Year</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while ($row = mysqli_fetch_assoc($get_books)): ?>

                                <tr>
                                    <td> <?php echo $row['book_name']; ?></td>
                                    <td><?php echo $row['author']; ?></td>
                                    <td><?php echo $row['isbn']; ?></td>
                                    <td><?php echo $row['publisher']; ?></td>
                                    <td><?php echo $row['publication_year']; ?></td>
                                    <td>

                                        <?php if ($row['status'] == 'available'): ?>
                                            <span class="badge success"><?php echo $row['status']; ?></span>
                                        <?php elseif ($row['status'] == 'borrowed'): ?>
                                            <span class="badge warning"><?php echo $row['status']; ?></span>
                                        <?php endif; ?>
                                    </td>

                                </tr>

                            <?php endwhile; ?>




                        </tbody>
                    </table>
                    <div class="pagination">
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>