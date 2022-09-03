<?php
session_start();
    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['createItem'])) {

        if ($_FILES['image']['name'] != '') {
            $ext = strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
            $filename = md5(microtime()).'.'.$ext;
            if($ext == 'jpg' || $ext == 'png' || $ext == 'jfif'){
                 $target_file = '../../img/'.$filename;
                  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $_POST['Photo'] = $filename;
                  }
            }else{
                echo "invalid image format!";
                   
            }
        }

        $name = $_POST["name"];
        $description = $_POST["description"];
        $uid = $_SESSION['resturantId'];
        $price = $_POST["price"];
        $photo=$_POST['Photo'];

        $sql = "INSERT INTO `food` (`foodName`, `foodPrice`, `foodDesc`, `uid`,`image`) VALUES ('$name', '$price', '$description', '$uid','$photo')";   
        $result = mysqli_query($conn, $sql);
        $foodId = $conn->insert_id;
        if ($result){
            echo "<script>alert('success');
                    window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                    window.location=document.referrer;
                </script>";
        }
    }

    if(isset($_POST['removeItem'])) {
        $foodId = $_POST["foodId"];
        $sql = "DELETE FROM `food` WHERE `foodId`=$foodId";  
        $result = mysqli_query($conn, $sql);
        if ($result){
           
            echo "<script>alert('Removed');
                window.location=document.referrer;
            </script>";
        }
        else {
            echo "<script>alert('failed');
            window.location=document.referrer;
            </script>";
        }
    }
    if(isset($_POST['updateItem'])) {
        $foodId = $_POST["foodId"];
        $foodName = $_POST["name"];
        $foodDesc = $_POST["desc"];
        $foodPrice = $_POST["price"];

        $sql = "UPDATE `food` SET `foodName`='$foodName', `foodPrice`='$foodPrice', `foodDesc`='$foodDesc' WHERE `foodId`='$foodId'";  
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "<script>alert('update');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
}
?>