<?php

$showalert=false;
$showerror=false;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    include '_dbconnect.php';
    $email=$_POST['signupemail'];
    $pass=$_POST['signuppassword'];
    $cpass=$_POST['signupcpassword'];
    
    $sql="select * from `users` where User_email='$email'";
    $result=mysqli_query($conn,$sql);

    //checking email exists or not
    $nuwrows=mysqli_num_rows($result);
    if($nuwrows>0){
        $showerror="Email Already Exists";
    }else{
        if($pass == $cpass){
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $addsql="INSERT INTO `users` (`User_email`, `User_pass`, `Date_time`) VALUES ('$email', '$hash', current_timestamp());";
            $result=mysqli_query($conn,$addsql);
            if($result){
                $showalert=true;
                header("Location: /zuhair/forum/index.php?signupsuccess=true");
                exit();
            }
        }else{
            $showerror="Passwords do not Match";
            header("Location: /zuhair/forum/index.php?signupsuccess=false&error=$showerror");
        }
    }

}


?>