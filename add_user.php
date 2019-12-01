<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="tracker";
$conn= mysqli_connect($servername,$username,$password,$dbname);
if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    if (isset($_POST['firstName'])) {
        $firstName = $_POST['firstName'];
    }
    if (isset($_POST['lastName'])) {
        $lastName = $_POST['lastName'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $pass = $_POST['password'];
        $hashed_password = md5($pass);
    }
    $search_query = "select * from users where email='".$email."'";
    $search_result = mysqli_query($conn, $search_query);
    if($search_result->num_rows > 0) {
        echo 1;
        return true;
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo 2;
        return true;
    }
    else if (!(preg_match('/[A-Za-z]/', $pass) && preg_match('/[0-9]/', $pass) && strlen($pass) >=8))
    {
        echo 3;
        return true;

    }
    else{
        $role= 1;
        $date=  date("Y/m/d");
        $table = "insert into users (firstname, lastname, email, password, role, date_joined) VALUES ('$firstName','$lastName','$email', '$hashed_password', '$role', '$date')";
        mysqli_query($conn, $table);
        $ins_query="select * from users";
        $all_result=mysqli_query($conn, $ins_query);
        $count= $all_result->num_rows;
        $number = $count;
        echo "<tr><td style='text-align: center'>$number</td><td style='text-align: center;'>$firstName</td><td style='text-align: center'>$lastName</td><td style='text-align: center'>$email</td></tr>";
    }

}
mysqli_close($conn);
