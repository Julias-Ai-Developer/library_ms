<?php
include '../database/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];

        $get_user = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($get_user) > 0) {
            $user = mysqli_fetch_assoc($get_user);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['full_name'] = $user['full_name'];

                $_SESSION['success'] = 'Login Successfully';
                header('Location: ../dashboard.php');
                exit();
            } else {
                $_SESSION['error'] = 'Incorrect password';
                header('Location: ../login.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'User not found';
            header('Location: ../login.php');
            exit();
        }
    }
} else {
    echo 'Invalid request method';
}
