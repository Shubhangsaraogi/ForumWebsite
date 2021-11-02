
<?php 
$showError=false;
$showAlert=false;

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include '_dbconnect.php';
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    $sql="SELECT * FROM `user` WHERE `user_email`='$email'; ";
    $result=mysqli_query($conn,$sql);

    $numRows=mysqli_fetch_assoc($result);
    if ($numRows>0) {
        $showError="Email is already registered";
    }
    else {
        if ($password==$cpassword) {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            
            $sql="INSERT INTO `user` ( `user_email`, `user_username`, `user_password`, `timestamp`) VALUES ('$email', '$username', '$hash', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if ($result) {
                header("location:/forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else {
            $showError="Password and confirm password don't match";
        }
    }
    header("location:/forum/index.php?signupsuccess=false&&showError=$showError");

}



?>