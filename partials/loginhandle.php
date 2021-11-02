<?php 
$showError=false;
$showAlert=false;

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include '_dbconnect.php';
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="SELECT * FROM `user` WHERE `user_email`='$email'; ";
    $result=mysqli_query($conn,$sql);

    $numRows=mysqli_num_rows($result);
    if ($numRows==1) {
        while ($row=mysqli_fetch_assoc($result)) {
            if (password_verify($password,$row['user_password'])) {
                $login=true;
                session_start();
                $_SESSION['login']=true;
                $_SESSION['username']=$row['user_username'];
                $_SESSION['user_id']=$row['user_id'];
                $showAlert="You have successfully loggedin";
                header("location:/forum/index.php?loginsuccess=true&&showAlert=$showAlert");
                exit();
            }
            else{
                $showError="Invalid Password";
            }
        }
    }
    else{
        $showError="Your email is not registered signup first";
    
    }
    header("location:/forum/index.php?loginsuccess  =false&&showError=$showError");

}



?>

