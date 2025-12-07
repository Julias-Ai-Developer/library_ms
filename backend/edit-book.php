<?php
include("../database/conn.php");

if($_SERVER['REQUEST_METHOD']== 'POST'){

if(isset($_POST['edit_book'])){
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
    $publication_year = mysqli_real_escape_string($conn, $_POST['publication_year']);
    


    $update_book = mysqli_query($conn, "UPDATE books SET book_name='$book_name', quantity='$quantity', author='$author', isbn='$isbn', publisher='$publisher', publication_year='$publication_year' WHERE id='$book_id'");

    if($update_book){
        $_SESSION['success'] = 'Book updated successfully';
        header('Location: ../books.php');
        exit();
    }else{
        $_SESSION['error'] = 'Failed to update book';
        header('Location: ../books.php');
        exit();
    }
    
}

}