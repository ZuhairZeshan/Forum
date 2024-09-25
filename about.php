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
    .container {
        min-height: 90vh;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 1em 0;
        text-align: center;
    }

    header h1 {
        margin: 0;
    }


    main {
        padding: 2em;
        max-width: 900px;
        margin: 0 auto;
    }

    section {
        background-color: #fff;
        padding: 2em;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 2em;
    }

    h2 {
        margin-top: 0;
        color: #333;
    }

    ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    .skill-box {
        margin-bottom: 1.5em;
        padding: 1em;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .skill-box h3 {
        margin-top: 0;
        color: #444;
    }

    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 1em 0;
        position: relative;
        width: 100%;
        bottom: 0;
    }

    @media (max-width: 768px) {
        nav ul li {
            display: block;
            margin: 0.5em 0;
        }

        .skill-box {
            padding: 0.5em;
        }

        main {
            padding: 1em;
        }
    }
    </style>

    <script>
    // Simple JavaScript to enhance interactivity
    document.addEventListener("DOMContentLoaded", function() {
        const sections = document.querySelectorAll("section");
        sections.forEach(section => {
            section.addEventListener("click", () => {
                section.classList.toggle("active");
            });
        });
    });
    </script>

</head>


<body>
    <?php include 'partials\_header.php'; ?>

    <div class="container my-3">
        <section class="about">
            <h2>About Tech Talks Forum</h2>
            <p>Welcome to the Tech Talks Forum(zDiscuss), your go-to destination for discussing the latest trends in technology,
                sharing knowledge, and networking with like-minded individuals. Our categories include Python, Django,
                Flask, and more, catering to both beginners and advanced developers.</p>
        </section>

        <section class="rules">
            <h2>Forum Rules and Regulations</h2>
            <ul>
                <li>Be respectful to all members and their opinions.</li>
                <li>No spamming, advertising, or self-promotion in the forums.</li>
                <li>Use appropriate language and avoid offensive content.</li>
                <li>Stay on topic and contribute to the discussion.</li>
                <li>Report any inappropriate content to the moderators.</li>
                <li>Ensure your posts add value to the community.</li>
            </ul>
        </section>
        
        <section class="website-functionality">
            <h2>Website Functionality</h2>
            <p>Our forum is designed to provide a seamless user experience with the following functionalities:</p>
            <ul>
                <li>Category-based discussions for organized content sharing.</li>
                <li>Login,Signup Functionality. Home,About,TopCategories and Contact pages and forms.</li>
                <li>Image Slider for pictures, Cards for Categories and many javascript features in it.</li>
                <li>User authentication for secure login and registration. Also use hashing to secure user accounts.</li>
                <li>Real-time notifications and updates on discussions.</li>
                <li>Responsive design for optimal viewing on any device.</li>
                <li>Advanced search functionality to easily find topics of interest.</li>
                <li>The Basic and the main purpose of this project is to check or challange my skills in <em>PHP and SQL</em>.</li>
            </ul>
        </section>
        
        <section class="skills">
            <h2>My Leadership and Development Skills</h2>
            <div class="skill-box">
                <h3>Leadership and Hardworking Skills</h3>
                <p>My name is Zuhair Zeshan. I have strong team-leading qualities and problem-solving skills, coupled with a dedication to hard
                    work and consistency. I thrive in fast-paced environments and am committed to delivering
                    high-quality results.</p>
            </div>

            <div class="skill-box">
                <h3>Programming and Web Development Skills</h3>
                <p>With expertise in both <em>front-end and back-end development</em>, I am proficient in PHP, MySQL, JavaScript,
                    HTML, and CSS. I have extensive experience in creating dynamic, responsive, and user-friendly web
                    applications using the <b>MERN stack</b></p>
            </div>
        </section>

    </div>

    <?php include 'partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>