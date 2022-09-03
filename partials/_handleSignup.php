<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address=$_POST['address'];
    $password = $_POST["password"];
    

    $existSql = "SELECT * FROM `user` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);

    if($numExistRows > 0)
    {
        $showError = "Username Already Exists";
        header("Location:../index2.php?signupsuccess=false&error=$showError");
    }
    else{
      
          $sql = "INSERT INTO `user` (`username`,`email`, `phone`, `usertype`, `password`,`Address`) VALUES ('$username', '$email', '$phone',2,'$password','$address')";  
          $result = mysqli_query($conn, $sql);
          $uid=$conn->insert_id;
          if ($result)
          {
              $showAlert = true;
              header("Location:../index2.php?signupsuccess=true");
          }
          else
          {
            $showError = "Insert Failed";
        header("Location:../index2.php?signupsuccess=false&error=$showError");
          }
  
    }
}
    
?>