<!DOCTYPE html>
<html lang="en">
<?php
include('../Php-Scripts/functions.php');
?>

<?php
if (!isset($_SESSION['user-details'])) {
    header("location:./conupdated.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixo | Community</title>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lusitana:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>
    <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">

    <link rel="stylesheet" href="../Content/CSS/community-profile.css">
    <link rel="stylesheet" href="../Content/CSS/sidebar.css">
    <style>
        .community-container::-webkit-scrollbar {
            display: none;
        }

        .audio-div {
            width: 100%;
            height: 86%;
            display: flex;
        }

        .stream-container {
            display: flex   ;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 80%;
        }

        .stream-container .empty-room{
            width: 100%;
            height: 100%;
            background-color: rgba(255,255,255,0.08);
            border-radius: 12px;
            margin-right: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #video-card {
            display: none;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            margin-right: 5px;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));            
        }

        .video-container {
            height: 100%;
            border: 1px solid black;
            width: 100%;
            border-radius: 12px;
            margin: 0;
        }

        .video-player {
            width: 100%;
            height: 100%;
        }

        .video-player video{
            width: 100%;
            height: 100%;
            border-radius: 12px;
        }
        .stream-controls {
            display: none;
            position: absolute;
            bottom: 1.5rem;
            width: 200px;
            height: 50px;
            gap: 10px;
            justify-content: space-evenly;
            align-items: center;
            background-color: black;
            border-radius: 30px;
        }

        .stream-controls button{
            padding: 5px;
            background-color: transparent;
            border: 1px solid white;
            border-radius: 50%;
            outline: none;
        }

        .community-details-section {
            width: 100%;
            height: 12%;
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 10px;
            margin: 0px 0px 10px 0px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
        }

        .user-counts-section {
            display: flex;
            align-items: center;
            gap: 5px;
            width: 120px;
            height: 45px;
            padding: 10px;
            border-radius: 25px;
            background-color: black;
        }

        [id^="agora-video-player-track-cam-"]{
            border-radius: 12px;
        }

        [id^="agora-video-player-track-video"]{
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <section id="toast" class="info" style="display: none;">
            <div id="icon-wrapper">
                <div id="icon"></div>
            </div>
            <div id="toast-message">
                <h4 id="toast-head"></h4>
                <p id="toast-notify"></p>
            </div>
            <button id="toast-close"></button>
            <div id="timer"></div>
        </section>
        <?php include('../Php-Scripts/sidebar.php'); ?>
        <div class="community-container content-container" style="margin-right: 5px;">
            <div class="community-details-section">
                <img src="../Uploads/Community-Data/67e2a4ad1326a.jpg" alt="logo"
                    style="width: 60px;border-radius: 50%;border: 3px solid black;background-color: #e3694a;height: 60px;object-fit: cover;">
                <div class="community-header" style="display: flex;width: 92%;">
                    <div class="community-name" style="flex-grow: 1;">
                        <h4 style="margin-bottom: 5px;">RDR Empire</h4>
                        <h6 style="margin: 0;">Real Life Talks</h6>
                    </div>
                    <div class="user-interactions" style="display: flex;align-items: center;gap: 20px;">
                        <div class="user-counts-section">
                            <img src="../Visuals/user.png" alt="" width="25px" height="25px"
                                style="filter: brightness(0) saturate(100%) invert(100%) sepia(99%) saturate(2%) hue-rotate(65deg) brightness(110%) contrast(101%);object-fit: cover;">
                            <p style="margin: 0;">12 Users</p>
                        </div>
                        <button
                            style="height: 45px;width: 80px;border-radius: 25px;border: none;padding: 12px;">BACK</button>
                    </div>
                </div>
            </div>
            <div class="audio-div">

                <div class="stream-container">
                    <div class="empty-room">
                        <h4 style="text-align: center;">Join the channel , Feel free to talk here ...<br> this is our chill out area buddy 😎</h4>
                        <?php 
                            $user_id = $_SESSION['user-details']['id'];
                            $userName = $_SESSION['user-details']['firstname']." ".$_SESSION['user-details']['lastname'];
                            $profile_img_src = "../Uploads/User-Data/".$_SESSION['user-details']['profile_image'];
                        ?>
                        <button class="join-btn" id="stream-join" onclick="joinStream(<?php echo $user_id;?>,'<?php echo $userName;?>','<?php echo $profile_img_src;?>')" style="height: 45px;width: 80px;border-radius: 25px;border: none;padding: 12px;">Join</button>
                    </div>
                    <div id="video-card">
                    </div>
                    <div class="stream-controls">
                        <button class="leave-btn" id="leave-btn" style="background-color: #ea4c46;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                id="_24x24_On_Light_Session-Leave" data-name="24x24/On Light/Session-Leave"
                                fill="#000000">

                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                                <g id="SVGRepo_iconCarrier">
                                    <rect id="view-box" width="24" height="24" fill="none"></rect>
                                    <path id="Shape"
                                        d="M2.95,17.5A2.853,2.853,0,0,1,0,14.75v-12A2.854,2.854,0,0,1,2.95,0h8.8a.75.75,0,0,1,0,1.5H2.95A1.362,1.362,0,0,0,1.5,2.75v12A1.363,1.363,0,0,0,2.95,16h8.8a.75.75,0,0,1,0,1.5Zm9.269-4.219a.751.751,0,0,1,0-1.061L14.939,9.5H5.75a.75.75,0,0,1,0-1.5h9.19L12.219,5.28A.75.75,0,1,1,13.28,4.22l4,4a.749.749,0,0,1,0,1.06l-4,4a.751.751,0,0,1-1.061,0Z"
                                        transform="translate(3.25 3.25)" fill="#ffffff"></path>
                                </g>

                            </svg>
                        </button>
                        <button class="mic" id="toggleMic-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="24px" height="24px"
                                viewBox="0 0 1920 1920">

                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M960.315 96.818c-186.858 0-338.862 152.003-338.862 338.861v484.088c0 186.858 152.004 338.862 338.862 338.862 186.858 0 338.861-152.004 338.861-338.862V435.68c0-186.858-152.003-338.861-338.861-338.861M427.818 709.983V943.41c0 293.551 238.946 532.497 532.497 532.497 293.55 0 532.496-238.946 532.496-532.497V709.983h96.818V943.41c0 330.707-256.438 602.668-580.9 627.471l-.006 252.301h242.044V1920H669.862v-96.818h242.043l-.004-252.3C587.438 1546.077 331 1274.116 331 943.41V709.983h96.818ZM960.315 0c240.204 0 435.679 195.475 435.679 435.68v484.087c0 240.205-195.475 435.68-435.68 435.68-240.204 0-435.679-195.475-435.679-435.68V435.68C524.635 195.475 720.11 0 960.315 0Z"
                                        fill-rule="evenodd"></path>
                                </g>

                            </svg>
                        </button>
                        <button class="camera" id="toggleCam-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                fill="none">

                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M16 10L18.5768 8.45392C19.3699 7.97803 19.7665 7.74009 20.0928 7.77051C20.3773 7.79703 20.6369 7.944 20.806 8.17433C21 8.43848 21 8.90095 21 9.8259V14.1741C21 15.099 21 15.5615 20.806 15.8257C20.6369 16.056 20.3773 16.203 20.0928 16.2295C19.7665 16.2599 19.3699 16.022 18.5768 15.5461L16 14M6.2 18H12.8C13.9201 18 14.4802 18 14.908 17.782C15.2843 17.5903 15.5903 17.2843 15.782 16.908C16 16.4802 16 15.9201 16 14.8V9.2C16 8.0799 16 7.51984 15.782 7.09202C15.5903 6.71569 15.2843 6.40973 14.908 6.21799C14.4802 6 13.9201 6 12.8 6H6.2C5.0799 6 4.51984 6 4.09202 6.21799C3.71569 6.40973 3.40973 6.71569 3.21799 7.09202C3 7.51984 3 8.07989 3 9.2V14.8C3 15.9201 3 16.4802 3.21799 16.908C3.40973 17.2843 3.71569 17.5903 4.09202 17.782C4.51984 18 5.07989 18 6.2 18Z"
                                        stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>

                            </svg>
                        </button>
                    </div>
                </div>
                <div class="joined-users" style="width: 20%;height: 100%;background-color: black;border-radius: 12px;"></div>
            </div>
        </div>
    </div>
    <script src="../Content/JS/sidebar.js"></script>
    <script src="../Content/JS/AgoraRTC_N-4.23.2.js"></script>
    <script src="../Content/JS/audio-room.js"></script>
</body>

</html>