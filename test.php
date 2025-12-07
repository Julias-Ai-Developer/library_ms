<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    echo $_SESSION['user_id'];
    echo $_SESSION['email'];
    echo $_SESSION['full_name'];   
    ?>
</body>
</html>