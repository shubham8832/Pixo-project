<!DOCTYPE html>
<?php 
include('../Php-Scripts/functions.php');
?>

<?php
    if(!isset($_SESSION['user-details'])){
        header("location:./conupdated.php");
        exit();        
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixo | Owners 👑</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- cropper js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <!--Quill js-->
    <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>
    <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">

    <link rel="stylesheet" href="../Content/CSS/profile.css">
    <link rel="stylesheet" href="../Content/CSS/sidebar.css">

    <style>
        
        .card {
            position: relative;
            width: 500px;
            height: 200px;
            background-color: #333;
            margin: 15px 0;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: background 0.3s;
            flex-direction:row;
        }

        .card:hover {
            background-color: #444;
            box-shadow:0 0 10px white;
        }

        .img {
           height:100%;
            width:40%;
        }

        .name {
            font-size: 30px;
            height:100%;
            width:60%;
            margin-top:15%;
            margin-left:20px;
            color:white;
        }

        .details {
            padding:40px;
            position: absolute;
            top:0;
            width: 100%;
            height: 100%;
            background-color: #db6d50;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.5s ease-in-out;
        }

        .card:nth-child(odd) .details {
            left: -100%;
        }
        .card:nth-child(even) .details {
            right: -100%;
        }
        .our-team {
            width: 100%;
            margin-left: 20%;
            max-height: 100vh; /* Adjust as needed */
            overflow-y: auto;
            padding-right: 10px; /* Prevents content from being cut off by scrollbar */
        }

        /* Hide scrollbar for Webkit browsers (Chrome, Safari) */
        .our-team::-webkit-scrollbar {
        display: none;
        }

        /* Hide scrollbar for Firefox */
        .our-team{
        scrollbar-width: none;
        }

        /* Hide scrollbar for IE, Edge */
        .our-team {
        -ms-overflow-style: none;
        }
    </style>
</head>
<body>
<div class="container-fluid" style="width:100%;margin:0;position:fixed;padding-left: 0;">
  <?php include('../Php-Scripts/sidebar.php');?>
  <div class="our-team" style="width:70%;margin-left:20%;padding:20px;">
    <div class="card">
        <div class="img"><img src="../Visuals/pixo_logo.png" style="height: 100%;width: 100%;"></div>
        <div class="name">Akshar Patel</div>
        <div class="details">
            <h2>Akshar Patel</h2>
            <p>Full Stack Developer</p>
            <p>Mail: akshar@gmail.com</p>
            <div class="social-icons">
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-facebook" style="padding-left: 15px;padding-right: 15px;"></i>
            <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
    </div>

    <div class="card">
    <div class="name">Ishita Patel</div>
    <div class="img"><img src="../Visuals/pixo_logo.png" style="height: 100%;width: 100%;"></div>
        
        <div class="details">
            <h2>Ishita Patel</h2>
            <p>Frontend Developer</p>
            <p>Mail: ishita@gmail.com</p>
            <div class="social-icons">
            <i class="fa-brands fa-instagram"style="gap:10px;"></i>
            <i class="fa-brands fa-facebook" style="padding-left: 15px;padding-right: 15px;"></i>
            <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
    </div>

    <div class="card">
    <div class="img"><img src="../Visuals/pixo_logo.png" style="height: 100%;width: 100%;"></div>
        <div class="name">Krishna Parekh</div>
        <div class="details">
            <h2>Krishna Parekh</h2>
            <p>UI/UX Designer</p>
            <p>Mail: krishna@gmail.com</p>
            <div class="social-icons">
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-facebook" style="padding-left: 15px;padding-right: 15px;"></i>
            <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="name">Riya Pandya</div>
      <div class="img"><img src="../Visuals/pixo_logo.png" style="height: 100%;width: 100%;"></div>
        <div class="details">
            <h2>Riya Pandya</h2>
            <p>UI/UX Designer</p>
            <p>Mail: riya@gmail.com</p>
            <div class="social-icons">
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-facebook" style="padding-left: 15px;padding-right: 15px;"></i>
            <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
    </div>

    <div class="card">
    <div class="img"><img src="../Visuals/pixo_logo.png" style="height: 100%;width: 100%;"></div>
        <div class="name">Shubham Mishra</div>
        <div class="details">
            <h2>Shubham Mishra</h2>
            <p>UI/UX Designer</p>
            <p>Mail: shubham@gmail.com</p>
            <div class="social-icons">
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-facebook" style="padding-left: 15px;padding-right: 15px;"></i>
            <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
    </div>

    </div>
    </div>
    <?php include('../Php-Scripts/popup.php');?>
    <script src="../Content/JS/sidebar.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll(".card");

            cards.forEach((card, index) => {
                const details = card.querySelector(".details");

                card.addEventListener("mouseenter", function () {
                    if (index % 2 === 0) {
                        details.style.transform = "translateX(100%)"; // Slide in from left
                    } else {
                        details.style.transform = "translateX(-100%)"; // Slide in from right
                    }
                });

                card.addEventListener("mouseleave", function () {
                    if (index % 2 === 0) {
                        details.style.transform = "translateX(-100%)"; // Slide back out left
                    } else {
                        details.style.transform = "translateX(100%)"; // Slide back out right
                    }
                });
            });
        });
    </script>

</body>
</html>
