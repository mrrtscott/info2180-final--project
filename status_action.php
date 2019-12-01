<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tracker";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(isset($_POST['id']) && isset($_POST['status_action'])){
    $id= $_POST['id'];
    $status_action= $_POST['status_action'];
    if($status_action==1){
        $delete_query = "update issues set status=1 WHERE id='" . $id . "'";
    }
    else if($status_action==2){
        $delete_query =  "update issues set status=2 WHERE id='" . $id . "'";
    }
    else{
        $delete_query =  "update issues set status=3 WHERE id='" . $id . "'";
    }
    mysqli_query($conn, $delete_query);
    echo "success";
    mysqli_close($conn);
}