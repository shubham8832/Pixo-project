<!DOCTYPE html>
<?php 
include('../Php-Scripts/functions.php');
include('../Php-Scripts/mail-send.php');
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
    <title>Pixo | Contact Us</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--Quill js-->
    <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>

    <!--Toastr js-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="../Content/CSS/profile.css">
    <link rel="stylesheet" href="../Content/CSS/sidebar.css">
    <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">
    <style>
        
        .main-container {
            display: flex;
            gap: 20px;
            margin-top:5%;
            margin-left:15%;
        }
        .left-card {
            background-color: #333;
            border: 2px solid white;
            padding: 40px;
            text-align: center;
            width: 500px;
            height: 500px;
            position: relative;
            overflow: hidden;
            transition: 0.3s ease-in-out;
            cursor: pointer;
        }
        .left-card:hover {
            background-color:rgb(237, 78, 34);
        }
        .contact-form {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:rgb(247, 97, 56);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
            padding: 20px;
            text-align: center;
            border-radius: 12px;
        }
        .left-card:hover .contact-form {
            opacity: 1;
            visibility: visible; 
        }
        .contact-form h5 {
            font-size: 25px;
            font-weight: 600;
            text-align: center;
            margin-bottom:50px;
            color:white;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background: transparent;
            border: 1px solid white;
            color: white;
            border-radius: 5px;
            font-size: 14px;
            text-align: left;
        }
        .contact-form input::placeholder, 
        .contact-form textarea::placeholder {
            color: white;
            font-size: 14px;
        }
        .contact-form button {
            background: white;
            color: black;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
        .right-card {
            background-color: #333;
            border: 1px solid white;
            padding: 15px;
            width: 220px;
            height: 220px;
            text-align: center;
            border-radius: 12px;
            transition: 0.3s ease-in-out;
        }
        .logo-box {
            background-color: #333;
            border: 1px solid white;
            width: 220px;
            height: 220px;
            border-radius: 12px;
            transition: 0.3s ease-in-out;
        }
       .left-card:hover,.right-card:hover,.logo-box:hover{
        box-shadow:0 0 10px white;
        cursor:pointer;
        transition: 0.3s ease-in-out;
       }
       .social-icons{
        margin-left:30%;
        margin-top:10%;
       }
       .social-icons i:hover{
        color:rgb(247, 97, 56);
        cursor:pointer;
       }
      
    </style>
</head>
<body>
<div class="container-fluid" style="width:100%;margin:0;position:fixed;padding-left: 0;">
<?php include('../Php-Scripts/sidebar.php');?>
    <div class="main-container" style="width:70%;">
        <div class="left-card">
            <h3 style="font-size:60px;">Bring Your Vision To Our Platform</h3>
            <p style="margin-top:5%;">Share your opinion with us.<br>
               Or want to add Feedback, You are at Right Place.<br>
               Don't Hesitate just go for it!</p>
               <p style="margin-top:20%;">Hover me! To get In touch with Team Pixo</p> 
               
               <div class="contact-form">
                <h5>Tell us more about yourself and what you've got in mind.</h5>
                <form action="./contactus.php?flag=done" method="post" id="contact-form">
                    <input autocomplete="off" type="text" name="uname" placeholder="Your Name" required>
                    <input type="email" autocomplete="off" name="sender-mail" placeholder="Your E-mail" required>
                    <textarea rows="3" autocomplete="off" placeholder="Describe about your idea or problem" required></textarea>
                    <button type="submit" name="send-feedback">Send</button>
                </form>
            </div>
        </div>
        
        <div class="right-column">
            <div class="logo-box">
                <img src="../Visuals/pixo_logo.png" style="width: 100%;" alt="">
            </div>
            <div class="right-card mt-3">
                <h5>Get in touch through</h5>
                <p>team@pixo.com</p>
                <p>SD Jain International College, Surat</p>
            </div>
            <div class="social-icons">
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-facebook" style="padding-left: 15px;padding-right: 15px;"></i>
            <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
       
    </div>
    </div>
    <?php include('../Php-Scripts/popup.php');?>
    <?php
    if(isset($_POST['send-feedback'])){
        $mail = $_POST['sender-mail'];
        $name = $_POST['uname'];
        if(isset($_GET['flag'])){
            $type = 'msg';
            $content = "Hey ".$name." , We've Received your feedback , it means lot to us , We will reach you out in short time Thanks for your valuable feedback .";
            if(mailSend($mail,$content,$type) === 'ok'){?>
                <script>
                    toastr.success("Your Feedback has been sent Successfully 😄","Pixo | Notification", { timeout: 4000 });
                </script>
            <?php
            }
        }
    }
    ?>
    <script src="../Content/JS/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.js"></script>
</body>
</html>
