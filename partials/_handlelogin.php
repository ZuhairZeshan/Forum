<?php

$showalert = false;
$showerror = false;
$invalid = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    include '_dbconnect.php';
    $email = $_POST['loginemail'];
    $pass = $_POST['loginpassword'];
    
    $sql = "SELECT * FROM `users` WHERE User_email='$email'";
    $result = mysqli_query($conn, $sql);

    // Confirming email
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['User_pass'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['Sno'];
            $_SESSION['useremail'] = $email;
            header('Location: /zuhair/forum/index.php');
            exit();
        } else {
           // Reload the modal with the invalid flag set
            header("Location: /zuhair/forum/index.php?loginerror=true"); 
            exit();
        }
    } else {
       // Reload the modal with the invalid flag set
        header("Location: /zuhair/forum/index.php?loginerror=true"); 
        exit();
    }
    
    
}
?>
