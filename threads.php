
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
    #floating {
        float: right;
    }

    #boxes {
        padding: 5px;
        border: 2px solid LimeGreen;
    }

    #question {
        color: green;
        text-decoration: none;
    }

    #combox {
        background-color: LimeGreen;
        /* color: white; */
    }
    </style>

</head>


<body>
    <?php include 'partials\_header.php'; ?>
    <?php include 'partials\_dbconnect.php'; ?>

    <?php 
        $id=$_GET['catid'];
        $sql="SELECT * FROM `categories` where Category_id=$id";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $cattitle=$row['Category_name'];
            $catdesc=$row['Category_description'];
        }
    ?>

    <?php
        $showalert=false;
        $method=$_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $tit=$_POST['title'];
            $des=$_POST['desc'];

            // Sanitize input to prevent XSS
            $tit=str_replace("<","&lt",$tit);
            $tit=str_replace(">","&gt",$tit);

            $des=str_replace("<","&lt",$des);
            $des=str_replace(">","&gt",$des);

            $sno=$_POST['sno'];
            $sql="INSERT INTO `threads` (`Thread_title`, `Thread_desc`, `Thread_cat_id`, `Thread_user_id`, `Timestamp`) VALUES ('$tit','$des', '$id', '$sno', current_timestamp());";
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
            <strong>Success!</strong> Your Question has been Added, Please wait for Community Respond. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>


    <!-- Welcome Tab -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><b>Welcome to <?php echo $cattitle ?> Forums</b></h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum.<strong>Stay on topic:</strong> Post relevant content.
                <strong>Avoid being a troll:</strong> Don't post inflammatory messages.
                <strong>Turn off Caps Lock:</strong> Avoid typing in all capital letters.
                <strong>Don't double post:</strong> Check if your question has already been asked.
                <strong>Search before posting:</strong> Make sure your topic hasn't been discussed before.
            </p>
            <p class="lead">
            <p>Posted by: <em>Zuhair</em></p>
            </p>
            <hr>
        </div>
    </div>

    <hr>
    <!-- Question Form -->
    <?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '<div class="container my-4">
    <div class="card" id="combox">
        <div class="card-body">
            <h1 class="py-2">Ask Questions?</h1>
            <form action="threads.php?catid='. $_GET['catid'] .'" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" required>
                    <div id="titleHelp" class="form-text">Keep your title as short and crisp as possible.</div>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Elaborate Your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                    <input type="hidden" name="sno" value="'. $_SESSION['sno'] .'">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>';
} else {
    echo '
    <div class="container">
        <h1 class="py-2">Ask Questions?</h1>
        <p class="lead my-0 text-center"><b>You are Not Logged in! Please Login to Post Questions</b></p>
    </div>';
}
?>

    <hr>
    <!-- Browse Questions -->
    <div class="container">
        <h1 class="py-2">Browse Questions</h1>
        <?php 
            $id=$_GET['catid'];
            $sql="SELECT * FROM `threads` where thread_cat_id=$id";
            $result=mysqli_query($conn,$sql);
            $noresult=true;
            while($row=mysqli_fetch_assoc($result)){
                $noresult=false;
                $tid=$row['Thread_id'];
                $ttitle=$row['Thread_title'];
                $tdesc=$row['Thread_desc'];
                $ttime=$row['Timestamp'];
                $tuser=$row['Thread_user_id'];
                
                $sql2="SELECT User_email FROM `users` where Sno='$tuser'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $email=$row2['User_email'];

                echo '<div class="media my-3" id="boxes">
                    <img class="mr-3" src="images\default-user-icon.jpg" width="40px" alt="Generic placeholder image">
                    <div class="media-body my-3">
                        <h5 class="mt-0"> <a id="question" href="thread.php?threadid='.$tid.'">Q: '. $ttitle .'</a></h5>
                        <div>
                            <p id="floating" class="fw-bold my-0">Asked By: '. $email .'</p><b>Content: </b>'. substr($tdesc,0,100) .'...<br><strong id="floating">Posted At: '.$ttime.'</strong>
                        </div>
                    </div>
                </div>';
            }
            if($noresult){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">No Questions Found</h1>
                    <p class="lead">Be The First Person To Ask a Question</p>
                </div>
                </div>';
            }
        ?>
    </div>


    <!-- Footer -->
    <?php include 'partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
