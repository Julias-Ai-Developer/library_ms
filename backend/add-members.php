<?php
session_start();
include("../database/conn.php");

if($_SERVER['REQUEST_METHOD']== 'POST'){
if(isset($_POST['add_member'])){
$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
$full_email = mysqli_real_escape_string($conn, $_POST['email']);
$full_phone = mysqli_real_escape_string($conn, $_POST['phone']);
$full_address = mysqli_real_escape_string($conn, $_POST['address']);
$full_membership_type = mysqli_real_escape_string($conn, $_POST['membership_type']);

$check_member = mysqli_query($conn, "SELECT * FROM users WHERE email='$full_email'");
if(mysqli_num_rows($check_member) == 0){
$sql_add_member = mysqli_query($conn,"INSERT INTO members(full_name, email, phone_number, address, membership_type) VALUES('$full_name', '$full_email', '$full_phone', '$full_address', '$full_membership_type')");

if($sql_add_member){
$_SESSION['success'] = 'Member added successfully';
header('Location: ../members.php');
exit();
}else{
$_SESSION['error'] = 'Member not added';
header('Location: ../members.php');
exit();
}

}else{
$_SESSION['error'] = 'Member already exists';
header('Location: ../members.php');
exit();
}
}else{
    $_SESSION['error'] = 'Invalid request method';
    header('Location: ../members.php');
    exit();
}
}else{
    $_SESSION['error'] = 'Invalid request method';
    header('Location: ../members.php');
    exit();
}
