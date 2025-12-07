<?php
include("../database/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST["book_id"];
    $member_id = $_POST["member_id"];
    $borrow_date = date("Y-m-d");
    $return_date = date("Y-m-d", strtotime("+14 days"));

    $query = "INSERT INTO borrow_book (book_id, member_id, borrow_date, return_date) VALUES ($book_id, $member_id, '$borrow_date', '$return_date')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Book borrowed successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}   