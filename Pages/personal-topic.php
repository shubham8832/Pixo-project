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
    <title>Pixo | Topic</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- cropper js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <!--toastr js-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">

    <link rel="stylesheet" href="../Content/CSS/profile.css">
    <link rel="stylesheet" href="../Content/CSS/sidebar.css">
    <link rel="stylesheet" href="../Content/CSS/community-profile.css">

    <style>
        .discussion-field {
            border-radius: 12px;
            padding: 5px 10px;
            outline: none;
            background-color: rgb(255, 255, 255, 0.1);
            color: white;
            width: 93%;
            height: 40px;
            margin: 5px 0rem;
        }

        .comment-card {
            padding: 15px;
            display: flex;
            gap: 15px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            margin: 10px 0px;
            width: fit-content;
        }

        .input-container {
            position: relative;
            margin: 20px 0;
        }

        .input-container input {
            width: 100%;
            padding: 10px;
            background: transparent;
            border: none;
            border-bottom: 2px solid #555;
            outline: none;
            color: #fff;
            font-size: 16px;
        }

        input {
            color: whitesmoke;
            transition: color 0.3s ease;
            spellcheck: false;
            -webkit-user-modify: read-write-plaintext-only;
        }

        /* input:focus {
            color: transparent;
        } */

        .contain {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card {
            transition: filter 0.3s ease-in-out;
        }

        .blur {
            filter: blur(5px);
        }

        .overlay.blur {
            display: block;
            z-index: 2;
            filter: blur(5px);
        }

        .buttons {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }

        .buttons button {
            padding: 10px 35px;
            margin: 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .I-btn,
        {
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        text-transform: uppercase;
        }

        .icon {

            cursor: pointer;
            font-size: 16px;
            padding: 4px;
            border-radius: 50%;

        }

        .lbl {
            padding: 10px;
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            /* Apply blur effect */
            display: none;
            z-index: 1;
        }
    </style>
</head>

<body>
    <!-- <div class="personal-profilesection"> -->
    <div id="overlay"></div>
    <div class="container-fluid">
        <?php include('../Php-Scripts/sidebar.php'); ?>
        <div class="content-container" style="width: 100%;height: 100%;overflow-y: scroll;">
            <div class="Personal-profile" style="display: flex;">
                <div class="profile-header d-flex align-items-center" style="width:100%;">
                    <?php
                    $topic_id = $_GET['id'];
                    $qry = "select user_id from topic_data where topic_id = $topic_id";
                    $query_run = mysqli_query($con, $qry);
                    $result = mysqli_fetch_assoc($query_run);
                    ?>
                    <div class="profile-image"
                        style="width: 80px; height: 80px; position: relative; display: inline-block;">
                        <?php

                        $profileId = $result['user_id'];
                        // Fetch user details
                        $qry = "SELECT id,firstname,lastname,username,profile_image,email FROM users WHERE id=$profileId";
                        $query_run = mysqli_query($con, $qry);
                        $user = mysqli_fetch_assoc($query_run);

                        if ($user): // If user data exists
                            ?>
                            <img src="<?php echo "../Uploads/User-Data/" . $user['profile_image']; ?>"
                                class="profile-pic me-3"
                                style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 2px solid white;"
                                alt="Profile Image">

                        <?php endif; ?>
                    </div>

                    <div style="padding-left: 2rem;flex-grow: 1;">
                        <h5>
                            <div class="profile-name">
                                <a href="profile.php?id=<?php echo $user['id']; ?>"
                                    style="text-decoration: none;color: white;">
                                    <?php
                                    echo $user['firstname'] . " " . $user['lastname'];
                                    ?>
                                    &nbsp;
                                </a>
                            </div>
                        </h5>
                        <p><?php
                        $profileId = $result['user_id'];
                        $qry = "SELECT COUNT(*) AS TotalCount FROM topic_data WHERE user_id = $profileId";
                        $query_run = mysqli_query($con, $qry);

                        if ($query_run) {
                            $row = mysqli_fetch_assoc($query_run); // Fetch the count
                            echo $row['TotalCount'];
                        } else {
                            echo "0";
                        }
                        ?> POSTS | <?php
                         $id = $_GET['id'];
                         $qry = "SELECT COUNT(*) AS TotalCount FROM community_data WHERE owner_id = $id";
                         $query_run = mysqli_query($con, $qry);

                         if ($query_run) {
                             $row = mysqli_fetch_assoc($query_run); // Fetch the count
                             echo $row['TotalCount'];
                         } else {
                             echo "0";
                         }
                         ?>&nbsp;Communities</p>
                    </div>
                </div>
                <?php
                $user_id = $user['id'];
                $loggined_user = $_SESSION['user-details']['id'];

                if ($loggined_user != $user_id) { ?>
                    <div
                        style="display: flex;width: 30%;margin-right: 15px;justify-content: end;margin-top: 10px;">
                        <button class="btn" id="openReport" style="width: 40%;border-radius: 15px;padding: 15px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="24" height="24"
                                viewBox="0 0 24 24" stroke="#ffffff" stroke-width="0.00024000000000000003">

                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd"
                                        d="M16,2 C16.2652165,2 16.5195704,2.10535684 16.7071068,2.29289322 L21.7071068,7.29289322 C21.8946432,7.4804296 22,7.73478351 22,8 L22,15 C22,15.2339365 21.9179838,15.4604694 21.7682213,15.6401844 L16.7682213,21.6401844 C16.5782275,21.868177 16.2967798,22 16,22 L8,22 C7.73478351,22 7.4804296,21.8946432 7.29289322,21.7071068 L2.29289322,16.7071068 C2.10535684,16.5195704 2,16.2652165 2,16 L2,8 C2,7.73478351 2.10535684,7.4804296 2.29289322,7.29289322 L7.29289322,2.29289322 C7.4804296,2.10535684 7.73478351,2 8,2 L16,2 Z M15.5857864,4 L8.41421356,4 L4,8.41421356 L4,15.5857864 L8.41421356,20 L15.5316251,20 L20,14.6379501 L20,8.41421356 L15.5857864,4 Z M12,16 C12.5522847,16 13,16.4477153 13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 C11,16.4477153 11.4477153,16 12,16 Z M12,6 C12.5522847,6 13,6.44771525 13,7 L13,13 C13,13.5522847 12.5522847,14 12,14 C11.4477153,14 11,13.5522847 11,13 L11,7 C11,6.44771525 11.4477153,6 12,6 Z">
                                    </path>
                                </g>
                            </svg>
                            <br>
                            <span class="nav-link-text">Report</span>
                        </button>
                        <br>
                    </div>
                    <?php
                }
                ?>
            </div>

        <div class="profile-nav" style="width: 100%;display: flex;">
            <div class="center-section" style="width: 74.5%;">

                <div id="tab1" class="user_post active">
                    <?php
                    $topic_id = $_GET['id'];
                    //$qry = "SELECT topic.`topic_id`,topic.`title`,topic.`body`,topic.`user_id`,topic.`categories`,topic.`community_id`,topic.`created_at`,user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic INNER JOIN `users` user ON topic.`user_id` = user.`id` WHERE topic.user_id=$id ORDER BY topic.`created_at` DESC";
                    $qry = "SELECT 
                                (SELECT COALESCE(SUM(vote.`vote_type`),0) FROM votes vote
                                WHERE vote.vote_topic_id = topic.topic_id) as `total_votes`,
                                topic.*,
                                user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic 
                                INNER JOIN `users` user ON topic.`user_id` = user.`id` 
                                LEFT JOIN votes vote on vote.`vote_topic_id` = `topic`.`topic_id`  
                                WHERE topic.`topic_id` = $topic_id;";
                    $run = mysqli_query($con, $qry);

                    if (!$run) {
                        die();
                    } else {
                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) { ?>
                                <div class="contain"
                                    style="position: relative;display: flex;flex-direction: column;justify-content: center;">
                                    <div class="card card-custom" id="card" style="width:100%">
                                        <div class="card-body" style="width: 100%;">
                                            <div class="d-flex align-items-center mb-3" style="width: 98%;">
                                                <img src="../Uploads/User-Data/<?php echo $row['profile_image']; ?>" alt="profile"
                                                    class="profile-pic" style="object-fit: cover;">
                                                <div class="ms-2" style="width: 100%;">
                                                    <div style="display: flex;width: 100%;">
                                                        <strong style="display: flex;align-items: center;width: 100%;">
                                                            <div style="flex-grow: 1;">
                                                                <?php echo $row['firstname'] . " " . $row['lastname']; ?></div>
                                                            <?php
                                                            $loggedInUserId = $_SESSION['user-details']['id'];
                                                            $topic_owner = $row['id'];
                                                            if ($topic_owner != $loggedInUserId) { ?>
                                                                <i class="fas fa-ellipsis-v icon"
                                                                    style="color: whitesmoke;cursor: pointer;"></i>
                                                                <?php
                                                            }
                                                            ?>
                                                        </strong>
                                                    </div>
                                                    <div style="width: 100%;display: flex;flex-grow: 1;">
                                                        <a href="profile.php?id=<?php echo $user['id']; ?>"
                                                            style="text-decoration: none;color: #e3694a;"
                                                            class="small-text"><span><?php echo $row['username']; ?></span></a>
                                                        <span class="date"><?php
                                                        $format_date = date("d-M-Y", strtotime($row['created_at']));
                                                        echo $format_date; ?></span>&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="heading">
                                                <h3 style="color: white;margin-bottom:2rem;">
                                                    <strong><?php echo $row['title']; ?></strong>
                                                </h3>
                                            </div>
                                            <div class="content" style="color: white;margin-bottom:15px;display: none;"
                                                id="content-<?php echo $row['topic_id']; ?>">
                                                <?php echo $row['body'] ?>
                                            </div>

                                            <a href="#" id="toggle-<?php echo $row['topic_id']; ?>"
                                                onclick="toggleData(<?php echo $row['topic_id']; ?>)"
                                                style="color: white;text-decoration: none;display: flex;justify-content: center;gap: 10px;margin-bottom: 10px;">Show
                                                More <span style="transform: rotate(-90deg);" ;>&lt;</span></a>

                                            <div class="d-flex align-items-center" style="gap: 10px;height: 40px;color: white;">
                                                <div class="votes">
                                                    <button id="btn-up-vote" onclick="vote(<?php echo $row['topic_id']; ?>,event)"
                                                        data-type="+1"
                                                        data-user-id="<?php echo $_SESSION['user-details']['id']; ?>">
                                                        <p class="arrow <?php
                                                        if (voteExist($_SESSION['user-details']['id'], $row['topic_id'])) {
                                                            $checktype = voteExist($_SESSION['user-details']['id'], $row['topic_id']);
                                                            if ($checktype == 1) {
                                                                echo "up";
                                                            } else {
                                                                echo "";
                                                            }
                                                        }
                                                        ?>" id="up-arrow-<?php echo $row['topic_id']; ?>"
                                                            style="transform: rotate(90deg);">&lt;
                                                        </p>
                                                    </button>
                                                    <p class="count" style="font-size: 1.1rem;width: 30px;text-align: center;"
                                                        id="vote-count-<?php echo $row['topic_id']; ?>">
                                                        <?php echo $row['total_votes']; ?>
                                                    </p>
                                                    <button id="btn-up-vote" onclick="vote(<?php echo $row['topic_id']; ?>,event)"
                                                        data-type="-1"
                                                        data-user-id="<?php echo $_SESSION['user-details']['id']; ?>">
                                                        <p class="arrow <?php
                                                        if (voteExist($_SESSION['user-details']['id'], $row['topic_id'])) {
                                                            $checktype = voteExist($_SESSION['user-details']['id'], $row['topic_id']);
                                                            if ($checktype != 1) {
                                                                echo "down";
                                                            } else {
                                                                echo "";
                                                            }
                                                        }
                                                        ?>" id="down-arrow-<?php echo $row['topic_id']; ?>"
                                                            style="transform: rotate(-90deg)" ;>
                                                            &lt;</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons" id="buttons">
                                        <button name="report-btn" class="report-btn" id="report-btn">Report</button>
                                    </div>
                                    <!-- Popup for Report -->
                                    <div class="popupReport" id="popupReport">
                                        <div class="popup-content">
                                            <button class="close-btn">&times;</button>
                                            <h4 class="pop-head">Why are you reporting this topic?</h4>
                                            <p class="description">Your report is anonymous . Others <br> will not be notified about
                                                it.</p>
                                            <form action="../Php-Scripts/update_report.php" id="report-form" method="post">
                                                <input type="hidden" name="redirection"
                                                    value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                                <input type="hidden" name="topic_id" value="<?php echo $row['topic_id']; ?>">
                                                <button type="submit" class="content" name="report-btn" value="1">Bullying or
                                                    unwanted content</button>
                                                <button type="submit" class="content" name="report-btn" value="2">Violence , Hate or
                                                    Exploitation</button>
                                                <button type="submit" class="content" name="report-btn" value="3">Selling or
                                                    promoting restricted items</button>
                                                <button type="submit" class="content" name="report-btn" value="4">Nudity or Sexual
                                                    Activity</button>
                                                <button type="submit" class="content" name="report-btn" value="5">Scam , Fraud or
                                                    spam</button>
                                                <button type="submit" class="content" name="report-btn" value="6">False
                                                    Information</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="discussion-input" style="margin: 10px 0px;">
                                    <form action="" method="post" id="discussion-form"
                                        style="display: flex;gap: 15px;align-items: center;width: 100%">
                                        <textarea type="text" name="discussion-input-field" class="discussion-field"
                                            id="discussion-input-field" placeholder="Your Thoughts ..."></textarea>
                                        <!--interactive-menu : width : 590px -->
                                        <button type="submit"
                                            style="width:43px;height: 40px;background-color: #e3694a;color: white;border-radius: 50%;outline: none;border: none;"
                                            id="discussion-btn" data-user-id="<?php echo $_SESSION['user-details']['id']; ?>"
                                            data-topic-id="<?php echo $_GET['id']; ?>">
                                            <i class="fa-regular fa-paper-plane send-mark"
                                                style="font-size: 1.4rem;width: 100%;height: 100%;display: flex;align-items: center;padding-left: 8px;"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="comment-section"
                                    style="width: 100%;display: flex;flex-direction: column;justify-content: center;">
                                    <div style="display: flex;justify-content: center;">
                                        <img src="../Visuals/strayrogue-bongo-cat.gif" alt=""
                                            style="width: 20%;border-radius: 12px;">
                                    </div>
                                    <h4 style="width: 100%;text-align: center;">Chal na ajax comment load karna...</h4>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                    <br>
                </div>
            </div>
            <div id="information" class="trending-panel" style="margin: 1rem 1rem 0rem 1rem;">
                <form id="profileForm" action="../Php-Scripts/update_profile.php" method="POST">
                    <span id="title">Your Details</span>
                    <?php
                    $profileId = $result['user_id'];

                    // Fetch user details
                    $qry = "SELECT firstname,lastname,username,email FROM users WHERE id=$profileId";
                    $query_run = mysqli_query($con, $qry);
                    $user = mysqli_fetch_assoc($query_run);

                    ?>

                    <div class="input-container">
                        <label class="lbl">Firstname :<br> <?php echo $user['firstname']; ?></label><br>
                    </div>
                    <div class="input-container">
                        <label class="lbl">Lastname :<br> <?php echo $user['lastname']; ?></label><br>
                    </div>

                    <div class="input-container">
                        <label class="lbl">Username :<br> <?php echo $user['username']; ?></label><br>
                    </div>

                    <div class="input-container">
                        <label class="lbl">Email : <br><?php echo $user['email']; ?></label><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <?php include('../Php-Scripts/popup.php'); ?>
    <!-- Popup for Report -->
    <div class="popupReport" id="popupReport_User">
        <div class="popup-content">
            <button class="close-btn">&times;</button>
            <h4 class="pop-head">Why are you reporting this User?</h4>
            <p class="description">Your report is anonymous . Others <br> will not be notified about it.</p>
            <form action="../Php-Scripts/update_report.php?report_type=user" id="report-form" method="post">
                <input type="hidden" name="redirection"
                    value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <input type="hidden" name="victim_id" value="<?php echo $_GET['id']; ?>">
                <button type="submit" class="content" name="report-btn" value="1">Bullying or unwanted
                    content</button>
                <button type="submit" class="content" name="report-btn" value="2">Violence , Hate or
                    Exploitation</button>
                <button type="submit" class="content" name="report-btn" value="3">Selling or promoting restricted
                    items</button>
                <button type="submit" class="content" name="report-btn" value="4">Nudity or Sexual Activity</button>
                <button type="submit" class="content" name="report-btn" value="5">Scam , Fraud or spam</button>
                <button type="submit" class="content" name="report-btn" value="6">False Information</button>
            </form>
        </div>
    </div>
    <?php
    if (isset($_SESSION['report']) && $_SESSION['report'] == true) { ?>
        <script>
            toastr.success("Reported Successfully.", "Pixo - Notification", { timeout: 4000 });
        </script>
        <?php
        unset($_SESSION['report']);
    }
    ?>
    <?php
    if (isset($_SESSION['reported']) && $_SESSION['reported'] = true) { ?>
        <script>
            toastr.error("You have already reported.", "Pixo - Notification", { timeout: 4000 });
        </script>
        <?php
        unset($_SESSION['reported']);
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Show buttons when clicking on the ellipsis icon
            document.querySelectorAll(".fa-ellipsis-v").forEach((icon, index) => {
                icon.addEventListener("click", function (event) {
                    event.stopPropagation(); // Prevent event bubbling

                    let card = document.querySelectorAll(".card")[index];
                    let buttons = document.querySelectorAll(".buttons")[index];

                    if (buttons.style.display === "flex") {
                        buttons.style.display = "none";
                        card.classList.remove("blur");
                    } else {
                        buttons.style.display = "flex";
                        card.classList.add("blur");
                    }
                });
            });
        });

        // Hide buttons when clicking outside
        document.addEventListener("click", function (event) {
            document.querySelectorAll(".card").forEach((card, index) => {
                let buttons = document.querySelectorAll(".buttons")[index];

                if (!card.contains(event.target) && !buttons.contains(event.target)) {
                    buttons.style.display = "none";
                    card.classList.remove("blur");
                }
            });
        });


        // Show report popup when clicking Report
        document.querySelectorAll(".report-btn").forEach((btn, index) => {
            btn.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevents closing due to outside click

                let popup = document.querySelectorAll(".popupReport")[index];
                let card = document.querySelectorAll(".card")[index];

                card.classList.add("blur");
                popup.style.display = "block";
            });
        });

        // Cancel button should close the popup
        document.querySelectorAll(".close-btn").forEach((button) => {
            button.addEventListener("click", function () {
                let popup = this.closest(".popupReport"); // Find nearest popup
                if (popup) {
                    popup.style.display = "none"; // Hide popup
                    document.querySelectorAll(".card").forEach((card) => {
                        card.classList.remove("blur"); // Remove blur from all cards
                    });
                }
            });
        });

        const reportform = document.getElementById('report-form');

        if (reportform != null) {
            reportform.addEventListener('submit', function (e) {
                const report_content = document.querySelectorAll('.content');
                report_content.forEach((index) => function () {
                    if (report_content[index] == false) {
                        report_content[index].disabled = true;
                    }
                    else {
                        report_content[index].disabled = false;
                    }
                });
            })
        }

        if(document.getElementById('openReport') != null){
            document.getElementById('openReport').addEventListener('click',function(){
                document.getElementById('popupReport_User').style.display = "block";
            })
        }
    </script>
    <script src="../Content/JS/sidebar.js"></script>
    <script src="../Content/JS/vote.js"></script>
    <script src="../Content/JS/discuss.js"></script>


</body>

</html>