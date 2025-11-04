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
    <title>Pixo | Topic</title>


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
    <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">


    <link rel="stylesheet" href="../Content/CSS/community-profile.css">
    <link rel="stylesheet" href="../Content/CSS/sidebar.css">

    <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>

    <!--toastr js-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">


    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <?php include('../Php-Scripts/sidebar.php'); ?>
        <div class="community-container">
            <div class="community-profile">
                <div class="upper-section" style="height: 100%;">
                    <?php

                    if (isset($_GET['id'])) {
                        $topic_id = $_GET['id'];
                        $qry = "SELECT community_id from topic_data where topic_id = $topic_id;";
                        if ($run = mysqli_query($con, $qry)) {
                            $result = mysqli_fetch_assoc($run);
                            $community_id = $result['community_id'];
                        }
                    }

                    $qry = "SELECT community.*,user.`username`,COUNT(uc.`user_id`) AS `total_user` from community_data community
                         inner JOIN `users` user on community.`owner_id` = user.`id`
                         LEFT JOIN user_community_data uc ON `uc`.`community_id` = `community`.`id`
                         where `community`.`id` = $community_id;";

                    $run = mysqli_query($con, $qry);

                    if (!$run) {
                        die();
                    } else {
                        $result = mysqli_fetch_assoc($run);

                        $array['community_data'] = [
                            'id' => $result['id'],
                            'name' => $result['community_name'],
                            'banner' => $result['banner'],
                            'logo' => $result['community_logo'],
                            'community_bio' => $result['community_bio'],
                            'owner_id' => $result['owner_id'],
                            'username' => $result['username'],
                            'total_user' => $result['total_user'],
                            'date' => $result['created_at']
                        ];
                    }
                    ?>
                    <img src="<?php echo $array['community_data']['banner']; ?>"
                        style="width: 100%;border-radius: 12px;height: 65%;object-fit: cover;" alt="banner"
                        class="community-banner">
                    <div class="down-section">
                        <div class="logo-title">
                            <img src="<?php echo $array['community_data']['logo']; ?>" alt="logo" class="community-logo">
                            <a href="./community-profile.php?id=<?php echo $array['community_data']['id'];?>" class="title" style="color: white;text-decoration: none;"><h3><?php echo $array['community_data']['name'];?></h3></a>
                        </div>
                        <div class="community-buttons">
                            <?php
                            if ($array['community_data']['owner_id'] == $_SESSION['user-details']['id']) {
                                echo '<button class="delete-community active" data-community-id="' . $array['community_data']['id'] . '">Remove</button>';
                                echo '<button class="add-content" style="display: block;" data-community-id="' . $array['community_data']['id'] . '">Add</button>';
                                echo '<button class="edit-community" style="display: block;" data-user-id="' . $_SESSION['user-details']['id'] . '" data-community-id="' . $array['community_data']['id'] . '">Edit</button>';
                            } else if (userCommunityExist($_SESSION['user-details']['id'], $array['community_data']['id'])) {
                                echo '<button class="join-community active" data-user-id="' . $_SESSION['user-details']['id'] . '" data-community-id="' . $array['community_data']['id'] . '">Leave</button>';
                                echo '<button class="add-content" style="display: block;" data-community-id="' . $array['community_data']['id'] . '">Add</button>';
                            } else {
                                echo '<button class="join-community" data-user-id="' . $_SESSION['user-details']['id'] . '" data-community-id="' . $array['community_data']['id'] . '">Join</button>';
                                echo '<button class="add-content" style="display: none;" data-community-id="'.$array['community_data']['id'].'">Add</button>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main">
                <div class="community-content">
                    <?php
                    $topic_id = $_GET['id'];
                    $qry = "SELECT COALESCE(SUM(vote.`vote_type`),0) as `total_votes`,
                         topic.*,
                         user.id,user.firstname,user.lastname,user.username,user.profile_image FROM `topic_data` topic 
                         inner JOIN `users` user ON `topic`.`user_id` = user.`id` 
                         LEFT JOIN votes vote on vote.`vote_topic_id` = `topic`.`topic_id` 
                         WHERE topic.`topic_id` = $topic_id ;";
                    $run = mysqli_query($con, $qry);

                    if (!$run) {
                        die();
                    } else {
                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) { ?>
                                <div class="contain"
                                    style="position: relative;display: flex;flex-direction: column;justify-content: center;">
                                    <div class="card card-custom" style="padding: 0;">
                                        <div class="card-body" style="width: 100%;">
                                            <div class="d-flex align-items-center mb-3" style="width: 100%;color: white;">
                                                <img src="<?php echo "../Uploads/User-Data/" . $row['profile_image']; ?>"
                                                    alt="profile" style="object-fit: cover;" class="profile-pic">
                                                <div class="ms-2" style="width: 100%;">
                                                    <strong style="display: flex;align-items: center;">
                                                        <div style="flex-grow: 1;">
                                                            <?php echo $row['firstname'] . " " . $row['lastname']; ?></div>
                                                            <?php 
                                                                $loggedInUserId = $_SESSION['user-details']['id'];
                                                                $topic_owner = $row['id'];
                                                                if($topic_owner != $loggedInUserId){?>
                                                                    <i class="fas fa-ellipsis-v icon" style="color: whitesmoke;cursor: pointer;"></i>
                                                                    <?php
                                                                }
                                                            ?>
                                                    </strong>
                                                    <div style="width: 100%;display: flex;flex-grow: 1;">
                                                    <a href="./profile.php?id=<?php echo $row['id'];?>" class="small-text" style="text-decoration: none;color: #e3694a;"><span class="small-text">p/<?php echo $row['username']?></span></a>
                                                        <span class="date"><?php
                                                        $format_date = date("d-M-Y", strtotime($row['created_at']));
                                                        echo $format_date;
                                                        ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="heading">
                                                <h3 style="color: white;margin-bottom:2rem;">
                                                    <strong><?php echo $row['title']; ?></strong>
                                                </h3>
                                            </div>
                                            <div class="content" style="color: white;margin-bottom:15px;display: none;"
                                                id="content-<?php echo $row['id']; ?>">
                                                <?php echo $row['body']; ?>
                                            </div>
                                            <a href="#" id="toggle-<?php echo $row['id']; ?>"
                                                onclick="toggleData(<?php echo $row['id']; ?>)"
                                                style="color: white;text-decoration: none;display: flex;justify-content: center;gap: 10px;margin-bottom: 10px;">Show
                                                More
                                                <span style="transform: rotate(-90deg)" ;>&lt;</span></a>

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
                                                            style="transform: rotate(90deg);">&lt;</p>
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
                                                            style="transform: rotate(-90deg)" ;>&lt;</p>
                                                    </button>
                                                </div>
                                                <!-- <a href="./community-topic.html?id=<?php echo $row['topic_id']; ?>" style="text-decoration: none;color: white;">
                                                    <div class="discuss">
                                                        <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00025"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.0001 8.517C8.58589 8.517 8.2501 8.85279 8.2501 9.267C8.2501 9.68121 8.58589 10.017 9.0001 10.017V8.517ZM16.0001 10.017C16.4143 10.017 16.7501 9.68121 16.7501 9.267C16.7501 8.85279 16.4143 8.517 16.0001 8.517V10.017ZM9.8751 11.076C9.46089 11.076 9.1251 11.4118 9.1251 11.826C9.1251 12.2402 9.46089 12.576 9.8751 12.576V11.076ZM15.1251 12.576C15.5393 12.576 15.8751 12.2402 15.8751 11.826C15.8751 11.4118 15.5393 11.076 15.1251 11.076V12.576ZM9.1631 5V4.24998L9.15763 4.25002L9.1631 5ZM15.8381 5L15.8438 4.25H15.8381V5ZM19.5001 8.717L18.7501 8.71149V8.717H19.5001ZM19.5001 13.23H18.7501L18.7501 13.2355L19.5001 13.23ZM18.4384 15.8472L17.9042 15.3207L17.9042 15.3207L18.4384 15.8472ZM15.8371 16.947V17.697L15.8426 17.697L15.8371 16.947ZM9.1631 16.947V16.197C9.03469 16.197 8.90843 16.23 8.79641 16.2928L9.1631 16.947ZM5.5001 19H4.7501C4.7501 19.2662 4.89125 19.5125 5.12097 19.6471C5.35068 19.7817 5.63454 19.7844 5.86679 19.6542L5.5001 19ZM5.5001 8.717H6.25012L6.25008 8.71149L5.5001 8.717ZM6.56175 6.09984L6.02756 5.5734H6.02756L6.56175 6.09984ZM9.0001 10.017H16.0001V8.517H9.0001V10.017ZM9.8751 12.576H15.1251V11.076H9.8751V12.576ZM9.1631 5.75H15.8381V4.25H9.1631V5.75ZM15.8324 5.74998C17.4559 5.76225 18.762 7.08806 18.7501 8.71149L20.2501 8.72251C20.2681 6.2708 18.2955 4.26856 15.8438 4.25002L15.8324 5.74998ZM18.7501 8.717V13.23H20.2501V8.717H18.7501ZM18.7501 13.2355C18.7558 14.0153 18.4516 14.7653 17.9042 15.3207L18.9726 16.3736C19.7992 15.5348 20.2587 14.4021 20.2501 13.2245L18.7501 13.2355ZM17.9042 15.3207C17.3569 15.8761 16.6114 16.1913 15.8316 16.197L15.8426 17.697C17.0201 17.6884 18.1461 17.2124 18.9726 16.3736L17.9042 15.3207ZM15.8371 16.197H9.1631V17.697H15.8371V16.197ZM8.79641 16.2928L5.13341 18.3458L5.86679 19.6542L9.52979 17.6012L8.79641 16.2928ZM6.2501 19V8.717H4.7501V19H6.2501ZM6.25008 8.71149C6.24435 7.93175 6.54862 7.18167 7.09595 6.62627L6.02756 5.5734C5.20098 6.41216 4.74147 7.54494 4.75012 8.72251L6.25008 8.71149ZM7.09595 6.62627C7.64328 6.07088 8.38882 5.75566 9.16857 5.74998L9.15763 4.25002C7.98006 4.2586 6.85413 4.73464 6.02756 5.5734L7.09595 6.62627Z" fill="#ffffff"></path> </g></svg>
                                                        <p class="count" id="comments" style="margin: 0;">14</p>
                                                    </div>
                                                </a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons" id="buttons">
                                        <button name="report-btn"  class="report-btn" id="report-btn">Report</button>
                                    </div>
                                    <!-- Popup for Report -->
                                    <div class="popupReport" id="popupReport">
                                        <div class="popup-content">
                                            <button class="close-btn">&times;</button>
                                            <h4 class="pop-head">Why are you reporting this topic?</h4>
                                            <p class="description">Your report is anonymous . Others <br> will not be notified about it.</p>
                                            <form action="../Php-Scripts/update_report.php" id="report-form" method="post">
                                                <input type="hidden" name="redirection" value="<?php echo htmlspecialchars( $_SERVER['REQUEST_URI']);?>">
                                                <input type="hidden" name="topic_id" value="<?php echo $row['topic_id']; ?>">
                                                <button type="submit" class="content" name="report-btn" value="1">Bullying or unwanted content</button>
                                                <button type="submit" class="content" name="report-btn" value="2">Violence , Hate or Exploitation</button>
                                                <button type="submit" class="content" name="report-btn" value="3">Selling or promoting restricted items</button>
                                                <button type="submit" class="content" name="report-btn" value="4">Nudity or Sexual Activity</button>
                                                <button type="submit" class="content" name="report-btn" value="5">Scam , Fraud or spam</button>
                                                <button type="submit" class="content" name="report-btn" value="6">False Information</button>
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
                    } ?>
                </div>
                <div class="community-details">
                    <div class="community-bio">
                        <p class="description">
                            <?php echo $array['community_data']['community_bio']; ?>
                        </p>
                        <div class="owner" style="display: flex;gap: 5px;">
                            <h6 style="margin: 0;display: flex;align-items: center;"><strong>Owner : </strong></h6>
                            <p class="owner-id mb-0" style="color: #e3694a;">
                                p/<?php echo $array['community_data']['username'] ?></p>
                        </div>
                        <hr>
                        <div class="bottom" style="display: flex;">
                            <div class="created-at">
                                <p class="date"><?php
                                $format_date = date("d-M-Y", strtotime($array['community_data']['date']));
                                echo $format_date; ?></p>
                                <h6>Created at</h6>
                            </div>
                            <div class="user-counts">
                                <p class="users"><?php echo $array['community_data']['total_user']; ?></p>
                                <h6>Users</h6>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="head-title"
                        style="font-size: 1.5rem;text-align: center;color: #e3694a;font-weight: 600;margin-bottom: 10px;">
                        Users</div>
                    <div class="users-section">
                        <?php
                        $qry = "SELECT uc.`id`,uc.`user_id`,uc.`community_id`,user.`id` AS `users_id`,user.`firstname`,user.`lastname`,user.`profile_image` FROM user_community_data uc 
                             inner JOIN `users` user on `uc`.`user_id` = `user`.`id` 
                             inner JOIN `community_data` community on `uc`.`community_id` = `community`.`id` 
                             WHERE `community`.`id` = $community_id;";
                        $run = mysqli_query($con, $qry);

                        if (!$run) {
                            die("database error : " - mysqli_error($con));
                        } else {
                            while ($row = mysqli_fetch_assoc($run)) { ?>
                                <a href="./profile.php?id=<?php echo $row['users_id']; ?>" style="text-decoration: none;">
                                    <div class="user-data">
                                        <img src="<?php echo "../Uploads/User-Data/" . $row['profile_image']; ?>"
                                            style="width: 40px;height: 40px;border-radius: 50%;border: 1px solid white;object-fit: cover;"
                                            alt="profile-img">
                                        <p class="username" style="color: white;margin: 0;display: flex;align-items: center;justify-content: center;">
                                            <?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
                                    </div>
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../Php-Scripts/popup.php'); ?>
    <div id="popupContainer" class="popup-container">
        <div class="popup-box" style="flex-direction: column;">
            <h4 class="pop-head">Do you want to remove <?php echo $array['community_data']['name']; ?> community ?</h4>
            <form action="../Php-Scripts/community_activity.php" method="post">
                <input type="hidden" name="community_id" value="<?php echo $array['community_data']['id']; ?>" />
                <input type="hidden" name="owner_id" value="<?php echo $_SESSION['user-details']['id']; ?>" />

                <div class="confirmation-btns" style="display: flex;justify-content: space-evenly;">
                    <button type="submit" name="del-community" class="delete-yes">Yes</button>
                    <button type="button" class="delete-no">No</button>
                </div>
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
    <script src="../Content/JS/community-profile.js"></script>
    <script src="../Content/JS/vote.js"></script>
    <script src="../Content/JS/discuss.js"></script>
    <script src="../Content/JS/sidebar.js"></script>
</body>

</html>