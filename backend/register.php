<?php
include '../database/conn.php';  // <-- FIX YOUR PATH

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['register'])) {

        // Collect form data
        $full_name     = $_POST['full_name'];
        $email         = $_POST['email'];
        $phone_number  = $_POST['phone_number'];
        $password      = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        //check if user already exists
        $check_user = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check_user) > 0) {
            echo "User with this email already exists";
        } else {


            // Correct INSERT of new user
            $sql = mysqli_query(
                $conn,
                "INSERT INTO users (full_name, email, phone_number, password)
             VALUES ('$full_name', '$email', '$phone_number', '$password_hash')"
            );


            if ($sql) {
                //successfull message
                echo "User registered successfully!";
            } else {
                //error message
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
