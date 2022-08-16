<?php
include_once 'db_conn.php';
$name=mysqli_real_escape_string($conn,$_POST['name']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$suggest=mysqli_real_escape_string($conn,$_POST['suggest']);
if(isset($_POST['feedsend'])){


    $sql="INSERT INTO feedback (name,email,suggest)VALUES('$name', '$email',' $suggest');";
    if(mysqli_query($conn,$sql)){
        echo"<script>alert('Your Feedback Message have been Sent')</script>";
        header("Location:  home.php");
    }
    else{
        echo"sorry";
    }
}
?>