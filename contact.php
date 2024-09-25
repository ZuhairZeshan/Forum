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
    .box{
        min-height: 80vh;
    }

    .box form {
        background-color: #fff;
        padding: 2em;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-weight: bold;
    }

    .box form input,
    form textarea {
        padding: 0.8em;
        margin-bottom: 1em;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    </style>
</head>


<body>
    <?php include 'partials\_header.php'; ?>

    <?php
        $method=$_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $name=$_POST['contactname'];
            $email=$_POST['contactemail'];
            $subject=$_POST['contactsubject'];
            $message=$_POST['contactmessage'];
            
            $sql="INSERT INTO `contacts` (`Name`, `Email`, `Subject`, `Message`) VALUES ('$name', '$email', '$subject', '$message');";
            $result=mysqli_query($conn,$sql);
            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Message has been Sent Successfully => THANK_YOU 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Please Try Again Later, Failed to Sent Message => THANK_YOU 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        }
    ?>

    <div class="container box my-4">
        <h1 class="text-center">Contact Us</h1>
        <p class="text-center">If you have any questions, feedback, or just want to say hello, feel free to reach out to
            us. We value your input and will get back to you as soon as possible.</p>
        <form class="row g-3 my-4" action="contact.php" method="post">
            <div class="col-12">
                <label for="inputAddress" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="contactname" placeholder="Firstname Lastname">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="contactemail" name="contactemail" placeholder="xyz@mail.com">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Subject</label>
                <input type="text" class="form-control" id="contactsubject" name="contactsubject">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                <textarea class="form-control" id="contactmessage" name="contactmessage" rows="3"></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="container btn btn-success">Sent Message</button>
            </div>
        </form>
    </div>

    <?php include 'partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>