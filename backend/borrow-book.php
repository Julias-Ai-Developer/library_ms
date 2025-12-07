<?php
include("../database/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST["book_id"];
    // $member_id = $_POST["member_id"];
    $borrow_date = date("Y-m-d");
    $return_date = date("Y-m-d", strtotime("+14 days"));
    $status = "borrowed";

    $query = "INSERT INTO borrow_book (book_id, borrow_date, return_date, status) VALUES ($book_id, '$borrow_date', '$return_date', '$status')";
    $result = mysqli_query($conn, $query);

    if ($result) {

        $update_book = mysqli_query($conn,"UPDATE books SET status='borrowed' WHERE id=$book_id");
        echo "Book borrowed successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}   