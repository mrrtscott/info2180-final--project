<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="tracker";
$conn= mysqli_connect($servername,$username,$password,$dbname);
if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["assigned_by"]) && isset($_POST["type"]) && isset($_POST['priority']) && isset($_POST['userId'])) {
    if (isset($_POST['title'])) {
        $title = $_POST['title'];
    }
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    }
    if (isset($_POST['assigned_by'])) {
        $assigned_by = $_POST['assigned_by'];
    }
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    }
    if (isset($_POST['priority'])) {
        $priority = $_POST['priority'];
    }
    if (isset($_POST['userId'])) {
        $userId = $_POST['userId'];
    }
    $create_date=  date("Y/m/d");
    $update_date = date("Y/m/d");
    $status= 1;
    $table = "insert into issues (title, description, type, assigned_by, priority, status, user_id, created, updated) VALUES ('$title','$description','$type', '$assigned_by', '$priority', '$status', '$userId', '$create_date', '$update_date' )";
    mysqli_query($conn, $table);
    $ins_query="select * from issues";
    $all_result=mysqli_query($conn, $ins_query);
    $count= $all_result->num_rows;
    $number = $count;
    echo "<tr><td style='text-align: center'>$number</td><td style='text-align: center;'>$title</td><td style='text-align: center'>$type</td><td style='text-align: center'><label for='status' class='label label-primary'>OPEN</label></td><td style='text-align: center'>$assigned_by</td><td style='text-align: center'>$create_date</td></tr>";
}
mysqli_close($conn);
