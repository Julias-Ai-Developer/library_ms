<?php
include '../database/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Handle Login
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $get_user = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($get_user) > 0) {
            $user = mysqli_fetch_assoc($get_user);

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Start sessions
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['full_name'] = $user['full_name'];

                // Redirect to dashboard
                header('Location: ../dashboard.php');
                exit();
            } else {
               
                header('Location: ../index.php?page=login&error=Incorrect password');
                exit();
            }
        } else {
            
            header('Location: ../index.php?page=login&error=User not found');
            exit();
        }
    }



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
            header('Location: ../index.php?page=signup');
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
                header('Location: ../index.php');
                exit();
            } else {
                $_SESSION['error'] = 'Error: ' . mysqli_error($conn);
                header('Location: ../index.php?page=signup');
                exit();
            }
        }
    }
}
?>