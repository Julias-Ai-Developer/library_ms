<?php
session_start();
include '../database/conn.php';  // <-- FIX YOUR PATH

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Handle Registration
    if (isset($_POST['register'])) {
        // Collect form data
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Check if user already exists
        $check_user = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($check_user) > 0) {
            $_SESSION['error'] = 'User with this email already exists';
            header('Location: ../register.php');
            exit();
        } else {
            // Insert new user
            $sql = mysqli_query(
                $conn,
                "INSERT INTO users (full_name, email, phone_number, password)
                 VALUES ('$full_name', '$email', '$phone_number', '$password_hash')"
            );

            if ($sql) {
                $_SESSION['success'] = 'User registered successfully! Please login.';
                header('Location: ../login.php');
                exit();
            } else {
                $_SESSION['error'] = 'Error: ' . mysqli_error($conn);
                header('Location: ../register.php');
                exit();
            }
        }
    }
}
