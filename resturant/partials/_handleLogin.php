<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"]; 
    
    $sql = "Select * from user where email='$email'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row=mysqli_fetch_assoc($result);
        $username=$row['username'];
        $userType = $row['usertype'];
        if($userType == 1) {
            $userId = $row['id'];
            if ($password== $row['password']){ 
                session_start();
                $_SESSION['resturantloggedin'] = true;
                $_SESSION['resturantname'] = $username;
                $_SESSION['resturantId'] = $userId;
                header("location: /krkfood/resturant/index.php?loginsuccess=true");
                exit();
            } 
            else{
                header("location: /krkfood/resturant/login.php?loginsuccess=false");
            }
        }
        else {
            header("location: /krkfood/resturant/login.php?loginsuccess=false");
        }
    } 
    else{
        header("location: /krkfood/resturant/login.php?loginsuccess=false");
    }
}    
?>