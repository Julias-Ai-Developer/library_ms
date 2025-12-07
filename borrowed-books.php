<?php
include 'database/conn.php';
include 'includes/header.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
$get_books = mysqli_query($conn, "SELECT * FROM borrow_book  bk JOIN books b ON bk.book_id=b.id  WHERE b.status ='borrowed'");

$page_title = 'Borrowed Books - Library Management System';
?>

<body>
    <div class="dashboard">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/navbar.php'; ?>

            <div class="content">
                <h1 class="page-title">Borrowed Books</h1>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Active Borrowings</h2>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Borrower</th>
                                <th>Book Title</th>
                                <th>Date Borrowed</th>
                                <th>Return Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($get_books)): ?>
                                <tr>
                                    <td><?php echo "kama"?></td>
                                    <td><?php echo $row['book_name']?></td>
                                    <td><?php echo $row['borrow_date']?></td>
                                    <td><?php echo $row['return_date']?></td>
                                    <td><span class="badge success">Active</span></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>