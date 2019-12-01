<!DOCTYPE HTML>
<html>
<?php
    session_start();
?>
<head lang="en">
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/AdminLTE.css">
</head>
<body class="hold-transition login-page" style="background-image: url('images/686742.jpg')">
<div class="login-box">
    <div class="login-logo">
        <a href="index.php"><b>W</b>elcome</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$servername="localhost";
$db_username="root";
$db_password="";
$dbname="tracker";
$error = "";
$conn= mysqli_connect($servername,$db_username,$db_password,$dbname) or die("DB connection failed");
if (isset($_POST['submit'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = md5($password);
        $query="SELECT * FROM users WHERE email='$email' AND password='$hashed_password'";
        $result=mysqli_query($conn, $query);
//        $result=$conn->query($query);
        if ($result->num_rows > 0) {
            echo "google";
            $rows = $result->fetch_assoc();
            $_SESSION['user']=$rows;
            header("Location: ". "home.php");
            exit(0);
        }
        else {
            header("Location: ". "index.php");
            exit(0);
        }
    }
}
mysqli_close($conn);
?>
</body>
</html>