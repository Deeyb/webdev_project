<?php
session_start();
if (isset($_SESSION["user"])){
    header("location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="registration.css">
    <link rel="icon" href="KLD LOGO.png">
</head>
<body>
<div class="container">
<?php
// include("dbConnect.php");X

if(isset($_POST["submit"])){
    $studentnumber = $_POST["studentnumber"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpassword"];

    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    $errors = array();


    if (empty($studentnumber) OR empty($fullname) OR empty($email) OR empty($password) OR empty($confirmPassword)){
        array_push($errors, "All fields are required");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    } elseif (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    } elseif ($password !== $confirmPassword) {
        array_push($errors, "Password does not match");
    } elseif (!preg_match('/^[a-zA-Z0-9\s-]+$/', $_POST['studentnumber'])) {
        array_push($errors, "Special characters are not allowed in the Student Number");
    }
    
    require_once "dbConnect.php";
    $sql ="SELECT * FROM users WHERE email = '$email' ";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        array_push($errors,"Email already exists!");
    }

    $sql ="SELECT * FROM users WHERE student_number = '$studentnumber' ";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        array_push($errors,"Student number already exists!");
    }

    if (count($errors) > 0 ) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }else{
        $sql = "INSERT INTO users (student_number, full_name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "ssss" , $studentnumber, $fullname, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        }else{
            die("Something went wrong.");
        }
    }

}
?>
        <div class="row">
            <div class="col-12">
            <form action="registration.php" method="POST">
            <img src="KLD LOGO.png" width="150px"/>
            <p class="display-6 text-success ">Account Registration</p>
            
            <div class="form-group">
                <input type="text" class="form-control" name="studentnumber" placeholder="Student Number">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email Address">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <input type="submit" class="form-control btnRegister" name="submit" value="Register">
            </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>