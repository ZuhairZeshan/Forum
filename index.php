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
    #hei {
        min-height: 433px;
    }

    /* hover effect on cards */
    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Adds a shadow */
        transform: translateY(-10px);
        /* Moves the card slightly upwards */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Smooth transition */
    }

    < !-- //styling for slider arrows -->

    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 10px;
    }

    .carousel-control-prev-icon::after,
    .carousel-control-next-icon::after {
        font-size: 2rem;
        color: white;
    }

    .carousel-control-prev,
    .carousel-control-next {
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1.5;
    }
    </style>


</head>


<body>
    <?php include 'partials\_dbconnect.php'; ?>
    <?php include 'partials\_header.php'; ?>

    <div id="hei">
        <!-- slider -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                    aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slider1.jpg" height="500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/slider2.jpg" height="500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/slider3.png" height="500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/slider4.jpg" height="500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/slid5.jpg" height="500" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Cards -->
        <div class="container">
            <h2 class="text-center my-3 mb-2">zDiscuss - Browse Categories</h2>
            <div class="row">
                <!-- Fetching -->
                <?php 
                $sql="SELECT * FROM `categories`";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    echo '<div class="col md-4 my-2">
                        <div class="card" style="width: 18rem;">
                            <img height="180px" src="images/card-'. $row['Category_id'] .'.jfif" class="card-img-top" alt="Image">
                            <div class="card-body">
                                <h5 class="card-title"> <a href="threads.php?catid='. $row['Category_id'] .'">'. $row['Category_name'] .'</a> </h5>
                                <p class="card-text">'. substr($row['Category_description'],0,100) .'...</p>
                                <a href="threads.php?catid='. $row['Category_id'] .'" class="btn btn-primary">View Threads</a>
                            </div>
                        </div>
                    </div>';
                }
            ?>

            </div>
        </div>

        <?php include 'partials\_footer.php'; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <?php 
        if (isset($_GET['loginerror']) && $_GET['loginerror'] == "true") {
            echo '<script>
                var loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
                loginModal.show();
            </script>';
        }
    ?>


</body>

</html>