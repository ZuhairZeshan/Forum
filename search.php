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
    .container{
        min-height: 90vh;
    }
    </style>

</head>


<body>
    <?php include 'partials\_dbconnect.php'; ?>
    <?php include 'partials\_header.php'; ?>


    <!-- Search Results -->
    <div class="container my-3">
        <h1 class="py-2">Search Results For <em>"<?php echo $_GET['search'] ?>"</em></h1>

        <?php
            $req=$_GET["search"];
            $sql="SELECT * FROM `threads` WHERE MATCH (Thread_title,Thread_desc) against ('$req');";
            $result=mysqli_query($conn,$sql);
            $noresults=true;
            while($row=mysqli_fetch_assoc($result)){
                $noresults=false;
                $title=$row['Thread_title'];
                $description=$row['Thread_desc'];
                $threadid=$row['Thread_id'];

                $url="thread.php?threadid=".$threadid;

                echo '<div class="results">
                    <h3><a href="'.$url.'" class="text-dark">'. $title .'</a></h3>
                    <p>'. $description .'</p>
                </div>';
            }
            if($noresults){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">No Results Found</h1>
                    <p class="lead">Suggestions:
                    <ul>
                        <li>Use Different Keywords</li>
                        <li>Use General keywords</li>
                        <li>Check Spellings of each Words</li>
                    </ul></p>
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