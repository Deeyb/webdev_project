<?php
session_start();
if (isset($_SESSION["user"])){
    header("location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="KLD LOGO.png">
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border p-4 box-area align-items-center">
        <?php
        if (isset($_POST["btnLogin"])) {
            $studentnumber = $_POST["studentnumber"];
            $password = $_POST["password"];

            require_once "dbConnect.php";
            $sql = "SELECT * FROM users WHERE student_number = '$studentnumber' ";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: dashboard.php");
                    die();
                }else{
                    echo '<div class="alert alert-danger">Password does not match</div>';
                }
            }else{
                echo '<div class="alert alert-danger">Student Number does not match</div>';
            }
    }
        ?>
            <div class="col">
                <div class="login text-center mb-3">
                    <img src="KLD LOGO.png" width="150px"/>
                    <p class="display-6 text-dark" style="font-family: 'Poppins';">Student Login</p>
                    <h4 class="text-success" style="font-family: 'Poppins';">Kolehiyo ng Lungsod ng Dasmariñas</h4>
                    <form action="login.php" method="POST">
                        <div class="input-group mb-2">
                            <input type="text" name="studentnumber" placeholder="Student Number" class="form-control form-control-md bg-white fs-6"/>
                        </div>

                        <div class="input-group mb-1">
                            <input type="password" name="password" placeholder="Password" class="form-control form-control-md bg-white fs-6"/>
                        </div>

                        <div class="login-btn mb-3">
                            <input type="submit" name="btnLogin" value="Login" class="btn-login btn-md btn-primary w-100"/>
                        </div>

                        <div class="forgt password mb-5">
                            <small> <a class="forgot-pass" href="#" target="_blank" style="text-align: center;">Forgot Password?</a> </small>
                        </div>

                        <div class="register ml-auto m-b5">
                            Don't have an account?
                            <a href="#" class="register-here" href="#" target="_blank">Register here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>