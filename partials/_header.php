
<style>
    #welcome{
        margin-bottom: 0px;
        margin-top: 5px;
        padding: 2px;
        padding-left: 5px;
        padding-right: 5px;
    }
</style>

<?php

session_start();

include 'partials\_dbconnect.php';

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">zDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Top Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

            $sql="SELECT Category_name,Category_id FROM `categories` LIMIT 3";
            $result=mysqli_query($conn,$sql);
            $noresult=true;
            while($row=mysqli_fetch_assoc($result)){
                echo '<li><a class="dropdown-item" href="threads.php?catid='.$row['Category_id'].'">'. $row['Category_name'] .'</a></li>';
            }

            echo '</ul>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="contact.php" tabindex="-1" >Contact</a>
            </li>
        </ul>';

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ //get means =>url can be send to and it open same thing.
            echo '
            <form class="d-flex" method="get" action="search.php" >  
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                <p class="text-light" id="welcome">Welcome:'. $_SESSION['useremail'] .'</p>
                <a href="partials/_logout.php" class="btn btn-outline-success">Logout</a>
            </form>';
        }else{
            echo '
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            <div class="mx-2">
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
            </div>';
        }

        

        echo '</div>
    </div>
    </nav>';

include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success!</strong> New User Created Successfully! 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

?>