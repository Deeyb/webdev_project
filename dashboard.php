<?php
session_start();
if (!isset($_SESSION["user"])){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <h1>WELCOME TO DASHBOARD!</h1>
    <a href="logout.php" class="btn btn-success">Logout</a>
    </div>

    <?php
    /* if (empty($studentnumber) OR empty($fullname) OR empty($email) OR empty($password) OR empty($confirmPassword)){
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password !== $confirmPassword) {
        array_push($errors, "Password does not match");
    }
    if (!preg_match('/^[a-zA-Z0-9\s-]+$/', $_POST['studentnumber'])) {
        array_push($errors, "Special characters are not allowed in the Student Number");
    } */
    ?>
</body>
</html>