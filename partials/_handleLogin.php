<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $username = $_POST["loginusername"];
    $password = $_POST["loginpassword"]; 
    
    $sql = "Select * from user where username='$username'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row=mysqli_fetch_assoc($result);
        $userId = $row['id'];
        if ($password==$row['password']){ 
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $userId;
            header("location:../index2.php?loginsuccess=true");
            exit();
        } 
        else{
            header("location:../index2.php?loginsuccess=false");
        }
    } 
    else{
        header("location:../index2.php?loginsuccess=false");
    }
}    
?>