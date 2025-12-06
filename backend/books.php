<?php
include '../database/conn.php';  // <-- FIX YOUR PATH

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_book'])) {
        $book_name = $_POST['book_name'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $publisher = $_POST['publisher'];
        $publication_year = $_POST['publication_year'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $status = 'available';


        $check_book = mysqli_query($conn, "SELECT * FROM books WHERE book_name='$book_name'");
        if (mysqli_num_rows($check_book) == 0) {
            $sql = mysqli_query($conn, "INSERT INTO books (book_name, author, isbn, publisher, publication_year, price, quantity, description, status) VALUES ('$book_name', '$author', '$isbn', '$publisher', '$publication_year', '$price', '$quantity', '$description', '$status')");
            if ($sql) {
                header("Location: ../books.php?page=books&success=Book added successfully");
                exit();
            } else {
                header("Location: ../books.php?page=books&error=Failed to add book");
                exit();
            }
        } else {
            header("Location: ../books.php?page=books&error=Book already exists");
            exit();
        }













    }
}
