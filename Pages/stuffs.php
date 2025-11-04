<!DOCTYPE html>
<html lang="en">

<?php 
include('../Php-Scripts/functions.php');
?>

<?php
    if(!isset($_SESSION['user-details'])){
        header("location:./conupdated.php");
        exit();        
    }
?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pixo | Easter</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome for Icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
      
        <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
        <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
        <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap">
        <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">
      
        <link rel="stylesheet" href="../Content/CSS/feed.css">
        <link rel="stylesheet" href="../Content/CSS/sidebar.css">
        <link rel="stylesheet" href="../Content/CSS/design.css">
      
      </head>
<body>
    <div class="blur"></div>
    <div class="container-fluid" style="width: 100%;margin: 0;overflow: hidden;z-index: 1;display: flex;align-items: center;justify-content: center;">
    <?php include('../Php-Scripts/sidebar.php');?>
        <div class="col-md-6 col-lg-7 p-3" id="center-section" style="overflow: scroll;width: 60%;height: calc(100vh - 10px);">
            <div class="upper-profile" style="display: flex;width: 100%;gap: 20px;background-color: #333;padding: 15px;border-radius: 12px;">
                <div class="profile-logo" style="
                width: 50px;
                height: 50px;
                border-radius: 50%;
                border: 1px solid;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 25px;
            "><img src="../Visuals/skull-pintrest.jpeg" style="width: 100%;height: 100%;border-radius: 50%;" alt="Heather Clark" class="sp-img"></div>
                <div class="details">
                    <h4 class="username" style="margin-bottom: 0;">Gem of The Pixo</h4>
                    <p class="id">@Mad_@_Skulls</p>
                    <div class="captions">
                        Waffle Is ❤ But only in Winter ...
                    </div>
                </div>
                <div class="tag" style="width: 50%;
                display: flex;
                align-items: center;
                justify-content: end;">
                    <img src="../Visuals/dimond.gif" alt="" class="tag-holder" style="width: 50px;height: 50px;">
                </div>
                
            </div>
            <div class="card card-custom" style="padding: 0;">
                <div class="card-body" style="width: 100%;">
                  <div class="d-flex align-items-center mb-3" style="width: 100%;">
                    <img src="../Visuals/user.png" alt="profile" class="profile-pic">
                    <div class="ms-2" style="width: 100%;">
                      <strong>p/TeamPixo</strong><br>
                      <div style="width: 100%;display: flex;flex-grow: 1;">
                        <span class="small-text">@choco_lover_0812</span>
                        <span class="date">25-FEB-2025</span>
                      </div>
                    </div>
                  </div>
                  <div class="heading">
                    <h3 style="color: white;margin-bottom:2rem;"><strong>We've got a small message for you .</strong></h3>
                  </div>
                  <div class="content" style="color: white;margin-bottom:15px;">
                    <div class="gift-box" style="width: 100%;display: flex;justify-content: center;align-items: center;">
                        <img src="../Visuals/giftbox.png" alt="" class="gift-img" style="width: 25%;">
                    </div>
                  </div>
    
                  <div class="d-flex justify-content-between align-items-center">
                  <span class="text-danger">❤ 100+</span>
                  <div class="view">
                    <span class="plus">
                      <i class="fa-solid fa-circle-plus"></i>
                    </span>
                    <span class="small-text" id="community">View Community</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-custom" style="padding: 0;">
                <div class="card-body" style="width: 100%;">
                  <div class="d-flex align-items-center mb-3" style="width: 100%;">
                    <img src="../Visuals/user.png" alt="profile" class="profile-pic">
                    <div class="ms-2" style="width: 100%;">
                      <strong>p/TeamPixo</strong><br>
                      <div style="width: 100%;display: flex;flex-grow: 1;">
                        <span class="small-text">@the_philosopher</span>
                        <span class="date">25-FEB-2025</span>
                      </div>
                    </div>
                  </div>
                  <div class="heading">
                    <h3 style="color: white;margin-bottom:2rem;"><strong>Are life hai aise chote mote din to aate rahenge ...</strong></h3>
                  </div>
                  <div class="content" style="color: white;margin-bottom:15px;">
                    <p class="text-content">Happy Birthday BTW</p>
                  </div>
    
                  <div class="d-flex justify-content-between align-items-center">
                  <span class="text-danger">❤ 100+</span>
                  <div class="view">
                    <span class="plus">
                      <i class="fa-solid fa-circle-plus"></i>
                    </span>
                    <span class="small-text" id="community">View Community</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-custom" style="padding: 0;">
                <div class="card-body" style="width: 100%;">
                  <div class="d-flex align-items-center mb-3" style="width: 100%;">
                    <img src="../Visuals/user.png" alt="profile" class="profile-pic">
                    <div class="ms-2" style="width: 100%;">
                      <strong>p/TeamPixo</strong><br>
                      <div style="width: 100%;display: flex;flex-grow: 1;">
                        <span class="small-text">@modern_majnu</span>
                        <span class="date">25-FEB-2025</span>
                      </div>
                    </div>
                  </div>
                  <div class="heading">
                    <h3 style="color: white;margin-bottom:2rem;"><strong>Happy Birthday Sev 😂</strong></h3>
                  </div>
    
                  <div class="d-flex justify-content-between align-items-center">
                  <span class="text-danger">❤ 100+</span>
                  <div class="view">
                    <span class="plus">
                      <i class="fa-solid fa-circle-plus"></i>
                    </span>
                    <span class="small-text" id="community">View Community</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-custom" style="padding: 0;">
                <div class="card-body" style="width: 100%;">
                  <div class="d-flex align-items-center mb-3" style="width: 100%;">
                    <img src="../Visuals/user.png" alt="profile" class="profile-pic">
                    <div class="ms-2" style="width: 100%;">
                      <strong>p/TeamPixo</strong><br>
                      <div style="width: 100%;display: flex;flex-grow: 1;">
                        <span class="small-text">@dhor_2k22_waado</span>
                        <span class="date">25-FEB-2025</span>
                      </div>
                    </div>
                  </div>
                  <div class="heading">
                    <h3 style="color: white;margin-bottom:2rem;"><strong>Janam Divas ni hardik subhechha Cap</strong></h3>
                  </div>
                  <div class="content" style="color: white;margin-bottom:15px;">
                    <p class="text-content">Aapde cover pn chaalshe 100-500/- na , Hu khushi khushi lei leva 👍</p>
                  </div>
    
                  <div class="d-flex justify-content-between align-items-center">
                  <span class="text-danger">❤ 100+</span>
                  <div class="view">
                    <span class="plus">
                      <i class="fa-solid fa-circle-plus"></i>
                    </span>
                    <span class="small-text" id="community">View Community</span>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="user-panel p-3">
            <h2 class="greetings-phase" style="
            height: 100%;
            display: flex;
            justify-content: center;
            padding: 14px;
            height: calc(100vh - 80px);
        ">
                        <br>It's Feb'25 ...<br><br><br><br>
                        Best wishes from Team Pixo to
                        Ishu 😄
                        <br>
                        <br>
                        <br>
                        <br>
                        Feel free to get chilled here ...
                    </h2>           
        </div>
        <div class="overlay" id="overlay" style="opacity: 0;visibility: hidden;display: none;z-index: -1;">
        </div>

    </div>
    <div class="container greeting-card" style="
    display: none;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 50px);
    width: 85%;
    background-color: #e3694a;
    margin: 0;
    padding: 0;
    border-radius: 12px;
    z-index: 10;
    position: fixed;
">
        <div class="click">
            <h2 class="greeting-text">Want to see what's inside?</h2>
            <div class="display" style="display: none;width: 100%;height: 100%;visibility: hidden;">
                <h1>Happiest Birthday our evershining Gem ✨</h1>
                <h4>Best wishes from Team Pixo 🎉</h4>

                <canvas id="birthday"></canvas>
            </div>
        </div>
        <div class="close-button" style="width: 30px;height: 30px;position: fixed;right: 10%;top: 40px;cursor: pointer;" onclick="closeCard()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">

                <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                
                <g id="SVGRepo_iconCarrier"> <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/> <path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/> </g>
                
            </svg>
        </div>
    </div>
    <div class="enable-confetti" style="width: 50px;height: 50px;border-radius: 50%;position: fixed;bottom: 30px;right: 20px;z-index: 5;cursor: pointer;"><img class="btn-confetti" src="../Visuals/confetti.gif" alt="" style="border-radius: 50%; width: 100%;"></div>
    <script src="../Content/JS/communities.js"></script>
    <script src="../Content/JS/design.js"></script>
</body>
</html>