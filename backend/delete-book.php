<?php
include("../database/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['delete_book'])){
    $book_id = $_POST["book_id"];
    $deleted_at = date("Y-m-d H:i:s");
    $delete_book = mysqli_query($conn, "UPDATE books SET deleted_at='$deleted_at' WHERE id=$book_id");
    if ($delete_book) {
        $_SESSION['success'] = 'Book deleted successfully';
        header('Location: ../books.php');
        exit();
    } else {
        $_SESSION['error'] = 'Failed to delete book';
        header('Location: ../books.php');
        exit();
    }
    }
}
?>