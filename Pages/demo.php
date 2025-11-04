<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hover Card Effect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <link rel="stylesheet" href="../Content/CSS/profile.css">
    <link rel="stylesheet" href="../Content/CSS/sidebar.css">

    <style>
       .card{
            position: relative;
            width: 70%;
            height: 180px;
            border-radius: 10px;
            cursor: pointer;
            background: #333;
            color: white;
            display: inline-block;
            margin: 10px;
            transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
            vertical-align: top;
            overflow: hidden;
        }    
        .card:hover {
            background: #e76f51;
            color: white;
        }
        .avatar {
            width:30%;
            height:160px;
            border-radius: 50%;
        }
        .card .content {
            text-align: center;
            width: 50%;
            display: inline-block;
            position: relative;
            z-index: 2;
        }
        .sub-content {
            position: absolute;
            top: 0;
            left: -100%;
            width:70%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            transition: left 0.3s ease-in-out;
        }
        .card:hover .sub-content {
            left:25%;
        }
        .scroll-container {
            margin-left: 25%;
        }
        .card:hover .content{
            opacity:0;
        }

        
    </style>
</head>
<body>
<div class="container-fluid" style="width: 100%; margin: 0; position: fixed;">
    <?php include('../Php-Scripts/sidebar.php'); ?>
    <div class="scroll-container">
    <div class="card">
        <img src="../Visuals/pixo_logo.png" alt="Avatar" class="avatar">
        <div class="content">
            <h2>Akshar Patel</h2>
        </div>
        <div class="sub-content">
            <h2>Akshar Patel</h2>
            <h4>Ful Stack Developer</h4>
            <p>Mail: akshar@gmail.com</p>
            <div class="icon">
                <i class="fa-brands fa-instagram" style="padding-right:10px;"></i>
                <i class="fa-brands fa-facebook" style="padding-right:10px;"></i>
                <i class="fa-brands fa-twitter" style="padding-right:10px;"></i>
            </div>
        </div>
    </div>

    <div class="card">
        <img src="../Visuals/pixo_logo.png" alt="Avatar" class="avatar">
        <div class="content">
            <h2>Ishita Patel</h2>
        </div>
        <div class="sub-content">
            <h2>Ishita Patel</h2>
            <h4>Backend Developer</h4>
            <p>Mail: ishita@gmail.com</p>
            <div class="icon">
                <i class="fa-brands fa-instagram" style="padding-right:10px;"></i>
                <i class="fa-brands fa-facebook" style="padding-right:10px;"></i>
                <i class="fa-brands fa-twitter" style="padding-right:10px;"></i>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2>Krishna Parekh</h2>
        </div>
        <img src="../Visuals/pixo_logo.png" alt="Avatar" class="avatar">
        <div class="sub-content">
            <h2>Krishna Parekh</h2>
            <h4>UIUX & Backend Developer</h4>
            <p>Mail: krishna@gmail.com</p>
            <div class="icon">
                <i class="fa-brands fa-instagram" style="padding-right:10px;"></i>
                <i class="fa-brands fa-facebook" style="padding-right:10px;"></i>
                <i class="fa-brands fa-twitter" style="padding-right:10px;"></i>
            </div>
        </div>
    </div>

    <div class="card">
        <img src="../Visuals/pixo_logo.png" alt="Avatar" class="avatar">
        <div class="content">
            <h2>Riya Pandya</h2>
        </div>
        <div class="sub-content">
            <h2>Riya Pandya</h2>
            <h4>Frontend Developer</h4>
            <p>Mail: riya@gmail.com</p>
            <div class="icon">
                <i class="fa-brands fa-instagram" style="padding-right:10px;"></i>
                <i class="fa-brands fa-facebook" style="padding-right:10px;"></i>
                <i class="fa-brands fa-twitter" style="padding-right:10px;"></i>
            </div>
        </div>
    </div>

    <div class="card">
        <img src="../Visuals/pixo_logo.png" alt="Avatar" class="avatar">
        <div class="content">
            <h2>Shubham Mishra</h2>
        </div>
        <div class="sub-content">
            <h2>Shubham Mishra</h2>
            <h4>Frontend Developer</h4>
            <p>Mail: shubham@gmail.com</p>
            <div class="icon">
                <i class="fa-brands fa-instagram" style="padding-right:10px;"></i>
                <i class="fa-brands fa-facebook" style="padding-right:10px;"></i>
                <i class="fa-brands fa-twitter" style="padding-right:10px;"></i>
            </div>
        </div>
    </div>


    </div>
</div>


</body>
</html>
