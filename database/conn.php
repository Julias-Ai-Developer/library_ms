<?php
// 1. Connect WITHOUT a database first
$conn = new mysqli('localhost', 'root', 'root');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Create database if missing
$create_database = mysqli_query(
    $conn,
    "CREATE DATABASE IF NOT EXISTS library_ms"
);

// 3. Reconnect but now selecting the database
$conn = new mysqli('localhost', 'root', 'root', 'library_ms');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 4. Create table users
$create_table_users = mysqli_query(
    $conn,
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100),
        email VARCHAR(100),
        phone_number VARCHAR(20),
        password VARCHAR(255)
    )"
);

//create book table
$create_table_books = mysqli_query(
    $conn,
    "CREATE TABLE IF NOT EXISTS books (
        id INT AUTO_INCREMENT PRIMARY KEY,
        book_name VARCHAR(100),
        author VARCHAR(100),
        isbn VARCHAR(20),
        publisher VARCHAR(100),
        publication_year VARCHAR(20),
        price VARCHAR(20),
        quantity VARCHAR(20),
        description VARCHAR(255),
        status VARCHAR(20) DEFAULT 'available'
    )"
);

if (!$create_table_books) {
    die("Error creating books table: " . mysqli_error($conn));
}
$create_table_members = mysqli_query(
$conn,"CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100),
    phone_number VARCHAR(20),
    address VARCHAR(255),
    membership_type VARCHAR(20)
) "

);

if (!$create_table_members) {
    die("Error creating members table: " . mysqli_error($conn));
}



// Add status column to existing tables (won't error if column already exists)
// mysqli_query($conn, "ALTER TABLE books ADD COLUMN status VARCHAR(20) DEFAULT 'available'");

?>