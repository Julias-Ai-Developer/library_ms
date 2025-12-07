<?php
include 'database/conn.php';
include 'includes/header.php';
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
$_get_members = mysqli_query($conn, "SELECT * FROM members");
$get_books = mysqli_query($conn, "SELECT * FROM books");

$page_title = 'Books - Library Management System';
?>

<body>
    <div class="dashboard">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/navbar.php'; ?>

            <div class="content">
                <h1 class="page-title">Books Library</h1>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">All Books</h2>
                        <button class="btn btn-add" onclick="openModal('bookModal')"><i class="fas fa-plus"></i> Add New
                            Book</button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Book Name</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Publisher</th>
                                <th>Year</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($get_books)) {
                                ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $row['book_name']; ?></td>
                                    <td><?php echo $row['author']; ?></td>
                                    <td><?php echo $row['isbn']; ?></td>
                                    <td><?php echo $row['publisher']; ?></td>
                                    <td><?php echo $row['publication_year']; ?></td>
                                    <td>Ugx <?php echo $row['price']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><span class="badge success"><?php echo ucfirst($row['status']); ?></span></td>
                                    <td>
                                        <button class="btn btn-add"
                                            style="padding: 5px 10px; font-size: 12px; background: #17a2b8;"
                                            onclick="openBorrowModal(<?php echo $row['id']; ?>, '<?php echo addslashes($row['book_name']); ?>')"
                                            title="Borrow Book">
                                            <i class="fas fa-book-reader"></i>
                                        </button>
                                        <button class="btn btn-add"
                                            style="padding: 5px 10px; font-size: 12px; background: #ffc107; margin-left: 5px;"
                                            onclick="openReturnModal(<?php echo $row['id']; ?>, '<?php echo addslashes($row['book_name']); ?>')"
                                            title="Return Book">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                        <button class="btn btn-add"
                                            style="padding: 5px 10px; font-size: 12px; background: #28a745; margin-left: 5px;"
                                            onclick="openEditModal('editModal<?php echo $row['id']; ?>')" title="Edit Book">
                                            <i class="fas fa-edit"></i>

                                        </button>
                                        <button class="btn btn-add"
                                            style="padding: 5px 10px; font-size: 12px; background: #dc3545; margin-left: 5px;"
                                            onclick="openDeleteModal(<?php echo $row['id']; ?>, '<?php echo addslashes($row['book_name']); ?>')"
                                            title="Delete Book">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>

                                <!-- Edit Book Modal -->
                                <div class="modal" id="editModal<?php echo $row['id']; ?>">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title">Edit Book</h2>
                                            <button class="close-modal"
                                                onclick="closeModal('editModal<?php echo $row['id']; ?>')">&times;</button>
                                        </div>
                                        <form method="post" action="./backend/edit-book.php">
                                            <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                                            <div class="form-group">
                                                <label>Book Title</label>
                                                <input type="text" name="book_name" value="<?php echo $row['book_name']; ?>"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Author</label>
                                                <input type="text" name="author" value="<?php echo $row['author']; ?>"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>ISBN</label>
                                                <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" name="price" value="<?php echo $row['price']; ?>"
                                                    step="0.01" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Publisher</label>
                                                <input type="text" name="publisher" value="<?php echo $row['publisher']; ?>"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Year Published</label>
                                                <input type="number" name="publication_year"
                                                    value="<?php echo $row['publication_year']; ?>" min="1000" max="2100"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>"
                                                    min="1" required>
                                            </div>
                                            <button type="submit" name="edit_book" class="btn-primary">Update
                                                Book</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Delete Book Modal -->
                                <div class="modal" id="deleteModal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title">Delete Book</h2>
                                            <button class="close-modal" onclick="closeModal('deleteModal')">&times;</button>
                                        </div>
                                        <form method="post" action="./backend/delete-book.php">
                                            <input type="hidden" name="book_id" id="delete_book_id">
                                            <p style="margin: 20px 0; font-size: 16px;">Are you sure you want to delete
                                                this book?</p>
                                            <p style="margin: 10px 0; font-weight: 600; color: #dc3545;"
                                                id="delete_book_name"></p>
                                            <p style="margin: 20px 0; font-size: 14px; color: #666;">This action cannot
                                                be undone.</p>
                                            <div style="display: flex; gap: 10px; margin-top: 20px;">
                                                <button type="button" onclick="closeModal('deleteModal')"
                                                    style="flex: 1; padding: 12px; background: #6c757d; color: white; border: none; border-radius: 8px; cursor: pointer;">Cancel</button>
                                                <button type="submit" name="delete_book"
                                                    style="flex: 1; padding: 12px; background: #dc3545; color: white; border: none; border-radius: 8px; cursor: pointer;">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Book Modal -->
    <div class="modal" id="bookModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add New Book</h2>
                <button class="close-modal" onclick="closeModal('bookModal')">&times;</button>
            </div>
            <form method="post" action="./backend/books.php">
                <div class="form-group">
                    <label>Book Title</label>
                    <input type="text" name="book_name" placeholder="Enter book title" required>
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" name="author" placeholder="Enter author name" required>
                </div>
                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" placeholder="Enter ISBN" required>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" placeholder="Enter price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label>Publisher</label>
                    <input type="text" name="publisher" placeholder="Enter publisher" required>
                </div>
                <div class="form-group">
                    <label>Year Published</label>
                    <input type="number" name="publication_year" placeholder="Enter year" min="1000" max="2100"
                        required>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" placeholder="Enter quantity" min="1" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" placeholder="Enter book description" rows="3" required></textarea>
                </div>
                <button type="submit" name="add_book" class="btn-primary">Add Book</button>
            </form>
        </div>
    </div>

    <!-- Borrow Book Modal -->
    <div class="modal" id="borrowModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Borrow Book</h2>
                <button class="close-modal" onclick="closeModal('borrowModal')">&times;</button>
            </div>
            <form method="post" action="./backend/borrow-book.php">
                <input type="hidden" name="book_id" id="borrow_book_id">
                <div class="form-group">
                    <label>Book Name</label>
                    <input type="text" id="borrow_book_name" readonly style="background: #f5f5f5;">
                </div>
                <div class="form-group">
                    <label>Borrower Name</label>
                    <select style="width: 100%; padding: 12px; border: 2px solid #E7F7F1; border-radius: 8px;"
                        name="membership_type" required>
                        <option value="select" selected disabled>
                            Select
                        </option>
                        <?php while ($row = mysqli_fetch_assoc($_get_members)): ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['full_name']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Borrow Date</label>
                    <input type="date" name="borrow_date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group">
                    <label>Return Date</label>
                    <input type="date" name="return_date" required>
                </div>
                <button type="submit" name="borrow_book" class="btn-primary">Confirm Borrow</button>
            </form>
        </div>
    </div>

    <!-- Return Book Modal -->
    <div class="modal" id="returnModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Return Book</h2>
                <button class="close-modal" onclick="closeModal('returnModal')">&times;</button>
            </div>
            <form method="post" action="./backend/return-book.php">
                <input type="hidden" name="book_id" id="return_book_id">
                <div class="form-group">
                    <label>Book Name</label>
                    <input type="text" id="return_book_name" readonly style="background: #f5f5f5;">
                </div>
                <div class="form-group">
                    <label>Return Date</label>
                    <input type="date" name="return_date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group">
                    <label>Condition</label>
                    <select name="condition" required>
                        <option value="">Select condition</option>
                        <option value="excellent">Excellent</option>
                        <option value="good">Good</option>
                        <option value="fair">Fair</option>
                        <option value="poor">Poor</option>
                    </select>
                </div>
                <button type="submit" name="return_book" class="btn-primary">Confirm Return</button>
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

        function openBorrowModal(bookId, bookName) {
            document.getElementById('borrow_book_id').value = bookId;
            document.getElementById('borrow_book_name').value = bookName;
            openModal('borrowModal');
        }

        function openReturnModal(bookId, bookName) {
            document.getElementById('return_book_id').value = bookId;
            document.getElementById('return_book_name').value = bookName;
            openModal('returnModal');
        }

        function openEditModal(modalId) {
            openModal(modalId);
        }


        function openDeleteModal(bookId, bookName) {
            document.getElementById('delete_book_id').value = bookId;
            document.getElementById('delete_book_name').textContent = bookName;
            openModal('deleteModal');
        }

        window.onclick = function (event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>

</html>