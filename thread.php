<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>zDiscuss - Forums</title>

    <style>
        #floating{
            float: right;
        }
        #boxes{
            padding: 5px;
            border: 2px solid LimeGreen;
        }
        #combox{
            background-color: LimeGreen;
        }
    </style>

</head>


<body>
    <?php include 'partials\_header.php'; ?>
    <?php include 'partials\_dbconnect.php'; ?>

    <?php 
        $id=$_GET['threadid'];
        $sql="SELECT * FROM `threads` where Thread_id=$id";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $title=$row['Thread_title'];
            $description=$row['Thread_desc'];
            $thread_id=$row['Thread_user_id'];

            $sql2="SELECT User_email FROM `users` where Sno='$thread_id'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            $name=$row2['User_email'];

        }
    ?>

    <?php
        $showalert=false;
        $method=$_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $comment=$_POST['comment'];
            $comment=str_replace("<","&lt",$comment); //replace < sign with &lt it ensure security of tags.
            $comment=str_replace(">","&gt",$comment);
            $sno=$_POST['sno'];
            $sql="INSERT INTO `comments` (`Comment_content`, `Thread_id`, `Comment_by`, `TimeStamp`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showalert=true;
            }
        }
    ?>

    <!-- Alert -->
    <?php
        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Comment has been Added! 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><b><?php echo $title ?></b></h1>
            <p class="lead"><?php echo $description ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum.<strong>Stay on topic:</strong> Post relevant content.
                <strong>Avoid being a troll:</strong> Don't post inflammatory messages.
                <strong>Turn off Caps Lock:</strong> Avoid typing in all capital letters.
                <strong>Don't double post:</strong> Check if your question has already been asked.
                <strong>Search before posting:</strong> Make sure your topic hasn't been discussed before.
            </p>
            <p class="lead">
                <p>Posted by: <em><?php echo $name; ?></em></p>
            </p>
            <hr>
        </div>
    </div>
    
    <hr>
    <!-- Comment Form -->  
    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '
        <div class="container">
            <div class="card" id="combox">
                <h1 class="py-2 mx-3">Post a Comment</h1>
                <div class="card-body">
                    <form action="threads.php?threadid='. $_GET['threadid'] .'"method="post">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Type Your Comment Here:</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            <input type="hidden" name="sno" value="<?php echo $_SESSION['."sno".']; ?>">
                        </div>
                        <button type="submit" class="btn btn-success">Post Comment</button>
                    </form>
                </div>
            </div>
        </div>';
    }else{
        echo'
        <div class="container">
         <h1 class="py-2">Post a Comment</h1>
            <p class="lead my-0 text-center"><b>You are Not Loggedin! Please Login to Comment</b></p>
        </div>';
    }
    ?>

    <hr>
    <!-- Discussions -->
    <div class="container">
        <h1 class="py-2">Discussions</h1>
        <?php 
            $id=$_GET['threadid'];
            $sql="SELECT * FROM `comments` where thread_id=$id";
            $result=mysqli_query($conn,$sql);
            $noresult=true;
            while($row=mysqli_fetch_assoc($result)){
                $id=$row['Comment_id'];
                $content=$row['Comment_content'];
                $time=$row['TimeStamp'];
                $user=$row['Comment_by'];
                $noresult=false;

                $sql2="SELECT User_email FROM `users` where Sno='$user'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $email=$row2['User_email'];

                echo '<div class="media my-3" id="boxes">
                    <img class="mr-3" src="images\default-user-icon.jpg" width="40px" alt="Generic placeholder image">
                    <div class="media-body my-3">
                        <p id="floating" class="fw-bold my-0">Commented By: '. $email .'</p><b>Comment: </b> '. $content .'<br><strong id="floating">Posted At: '.$time.'</strong>
                    </div>
                    
                </div>';
            } 
            
            if($noresult){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">No Comments Found</h1>
                    <p class="lead">Be The First Person To Comment</p>
                </div>
                </div>';
            }

        ?>
    </div>


    <?php include 'partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>