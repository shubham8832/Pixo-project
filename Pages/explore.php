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
    <title>Pixo | Explore</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" href="../Content/CSS/explore.css">
    <link rel="stylesheet" href="../Content/CSS/sidebar.css">
    <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">

</head>

<body>
    <div class="container-fluid content-container" style="width: 100%;margin: 0;overflow: hidden;">
        <?php include('../Php-Scripts/sidebar.php'); ?>

        <div class="col-md-10 col-lg-10 explore-section">
            <div class="top-section" style="width: 100%;display: flex;">
                <form id="search-form" method="get" style="width: 100%;display: flex;">
                    <span class="e-search-bar" style="width: 80%;">
                        <div class="search-icon"></div>
                        <input type="text" autocomplete="off" name="search" id="search" placeholder="Search Pixo">
                        <a href="./explore.php">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" width="23px" height="23px"
                                viewBox="0 0 32 32" version="1.1" fill="#000000">

                                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                <g id="SVGRepo_iconCarrier">
                                    <title>cross-circle</title>
                                    <desc>Created with Sketch Beta.</desc>
                                    <defs> </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                        sketch:type="MSPage">
                                        <g id="Icon-Set" sketch:type="MSLayerGroup"
                                            transform="translate(-568.000000, -1087.000000)" fill="#e3694a">
                                            <path
                                                d="M584,1117 C576.268,1117 570,1110.73 570,1103 C570,1095.27 576.268,1089 584,1089 C591.732,1089 598,1095.27 598,1103 C598,1110.73 591.732,1117 584,1117 L584,1117 Z M584,1087 C575.163,1087 568,1094.16 568,1103 C568,1111.84 575.163,1119 584,1119 C592.837,1119 600,1111.84 600,1103 C600,1094.16 592.837,1087 584,1087 L584,1087 Z M589.717,1097.28 C589.323,1096.89 588.686,1096.89 588.292,1097.28 L583.994,1101.58 L579.758,1097.34 C579.367,1096.95 578.733,1096.95 578.344,1097.34 C577.953,1097.73 577.953,1098.37 578.344,1098.76 L582.58,1102.99 L578.314,1107.26 C577.921,1107.65 577.921,1108.29 578.314,1108.69 C578.708,1109.08 579.346,1109.08 579.74,1108.69 L584.006,1104.42 L588.242,1108.66 C588.633,1109.05 589.267,1109.05 589.657,1108.66 C590.048,1108.27 590.048,1107.63 589.657,1107.24 L585.42,1103.01 L589.717,1098.71 C590.11,1098.31 590.11,1097.68 589.717,1097.28 L589.717,1097.28 Z"
                                                id="cross-circle" sketch:type="MSShapeGroup"> </path>
                                        </g>
                                    </g>
                                </g>

                            </svg>

                        </a>
                    </span>
                    <span class="select-item">
                        <select name="categories" id="categories">
                            <option value="topic">Topic</option>
                            <option value="users">User</option>
                            <option value="Community">Communities</option>`

                        </select>
                    </span>
                </form>
            </div>
            <?php
            if ((isset($_GET['search']) && $_GET['search'] != null) && (isset($_GET['categories']) && ($_GET['categories'] != null))) {
                $search_data = $_GET['search'];
                $categories = $_GET['categories'];

                if ($categories == "topic") { ?>
                    <div class="users-section">
                        <?php
                        $topic = $_GET['search'];
                        $qry = "SELECT topic.topic_id,topic.title,topic.body,topic.community_id,
                                    user.id,user.firstname,user.lastname,user.profile_image from topic_data topic
                                    inner join users user ON topic.user_id=user.id
                                    WHERE topic.title like '%$topic%'";

                        $run = mysqli_query($con, $qry);

                        if (mysqli_num_rows($run) > 0) { ?>
                            <h2>Topic</h2>
                            <div class="user-container" style="display: flex;flex-wrap: wrap;gap: 30px;">
                                <?php
                                $result = mysqli_query($con, $qry);
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $html = $row['body'];

                                    if (preg_match('/<img\s+[^>]*src=["\']([^"\']+)["\']/i', $html, $matches)) {
                                        $img = $matches[1];
                                    } else {
                                        $img = '../Uploads/Topic-data/default.webp';
                                    }

                                    ?>
                                    <?php
                                    if ($row['community_id'] != 0) {
                                        $search_data = '
                                            <a href="./community-topic.php?id=' . $row['topic_id'] . '" style="text-decoration: none;color: white;width: 28.45%;">
                                                <div class="e-card" style="width: 100%;height: 262px;">
                                                    <img src="' . $img . '" alt="recently-searched">
                                                    <div class="author">
                                                        <img src="../Uploads/User-Data/' . $row['profile_image'] . '" alt="Author">
                                                        <span class="username"></span>
                                                        <span>' . $row['firstname'] . ' ' . $row['lastname'] . '</span>
                                                    </div>
                                                    <div class="title">' . $row['title'] . '</div>
                                                </div>
                                            </a>';
                                    } else {
                                        $search_data = '
                                            <a href="./personal-topic.php?id=' . $row['topic_id'] . '" style="text-decoration: none;color: white;width: 28.45%;">
                                                <div class="e-card" style="width: 100%;height: 262px;">
                                                    <img src="' . $img . '" alt="recently-searched">
                                                    <div class="author">
                                                        <img src="../Uploads/User-Data/' . $row['profile_image'] . '" alt="Author">
                                                        <span class="username"></span>
                                                        <span>' . $row['firstname'] . ' ' . $row['lastname'] . '</span>
                                                    </div>
                                                    <div class="title">' . $row['title'] . '</div>
                                                </div>
                                            </a>';
                                    }
                                    echo $search_data;
                                }
                        } else { ?>
                                <div class="aftermsg" style="width: 100%;text-align: center;">No Topic Found</div>
                                <?php
                        } ?>
                        </div>
                    </div>
                    <?php
                }

                if ($categories == "users") { ?>
                    <div class="users-section">
                        <?php
                        $username = $_GET['search'];
                        $qry = "SELECT id,username,firstname,lastname,profile_image from `users` where username like '%$username%'";
                        $result = mysqli_query($con, $qry);

                        if (mysqli_num_rows($result) > 0) { ?>
                            <h2>Users</h2>
                            <div class="user-container">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <a href="./profile.php?id=<?php echo $row['id']; ?>"
                                        style="text-decoration: none; color: white; width: 48%;">
                                        <div class="user-card">
                                            <div class="user-info">
                                                <img src="../Uploads/User-Data/<?php echo $row['profile_image']; ?>" alt="User">
                                                <div class="user-details">
                                                    <span class="username" style="color:#e3694a;"><?php echo $row['username']; ?></span>
                                                    <span><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></span>
                                                </div>
                                            </div>
                                            <div class="post-count"><img src="../Visuals/Chevron down.png" style="width: 20px;" alt="">
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                } ?>
                            </div>
                            <?php
                        } else { ?>
                            <div class="aftermsg" style="width: 100%;text-align: center;">No User Found</div>
                            <?php
                        } ?>
                    </div>
                    <?php
                }

                if ($categories == "Community") { ?>
                    <div class="users-section">
                        <?php
                        $community = $_GET['search'];
                        $qry = "SELECT community.id, community.community_name,community.banner,community.community_logo,community.owner_id,
                        user.username, user.profile_image from community_data community
                        inner JOIN users user on community.owner_id = user.id
                        WHERE community.community_name LIKE '%$community%';";

                        $result = mysqli_query($con, $qry);

                        if (mysqli_num_rows($result) > 0) { ?>
                            <h2>Communities</h2>
                            <div class="user-container">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $community_id = $row['id'];
                                    $qry = "SELECT COUNT(uc.`user_id`) AS `total_user` FROM user_community_data uc 
                                    inner JOIN `users` user on `uc`.`user_id` = `user`.`id` 
                                    inner JOIN `community_data` community on `uc`.`community_id` = `community`.`id` 
                                    WHERE `community`.`id` = $community_id;";

                                    $run = mysqli_query($con, $qry);
                                    $count_result = mysqli_fetch_assoc($run);
                                    $user_counts = $count_result['total_user'];
                                    ?>
                                    <div class="e-card communities">
                                        <img src="<?php echo $row['banner']; ?>" alt="banner">
                                        <div class="author">
                                            <img src="<?php echo $row['community_logo']; ?>" alt="Author">
                                            <span style="color: white;"><?php echo $row['community_name']; ?></span>
                                            <button type="button" class="button"><a
                                                    href="./community-profile.php?id=<?php echo $row['id']; ?>"
                                                    style="text-decoration: none;color: white;">Visit</a></button>
                                        </div>
                                        <a href="./profile.php?id=<?php echo $row['owner_id']; ?>" class="title"
                                            style="text-decoration: none;color: #bbb6b6;">p/<?php echo $row['username']; ?></a>
                                        <div class="member"><?php echo $user_counts; ?> Members</div>
                                    </div>
                                    <?php
                                } ?>
                            </div>
                            <?php
                        } else { ?>
                            <div class="aftermsg" style="width: 100%;text-align: center;">No Community Found</div>
                            <?php
                        } ?>
                    </div>
                    <?php
                }
            } else { ?>
                <div class="users-section">
                    <?php

                    $qry = "SELECT COALESCE(SUM(vote.`vote_type`),0) as `total_votes`,
                topic.topic_id,topic.title,topic.body,topic.community_id,
                user.id,user.firstname,user.lastname,user.profile_image from topic_data topic
                INNER JOIN `users` user ON topic.`user_id` = user.`id` 
                LEFT JOIN votes vote on vote.`vote_topic_id` = `topic`.`topic_id` 
                GROUP BY topic.`topic_id` 
                ORDER BY COALESCE(SUM(vote.`vote_type`),0) DESC LIMIT 3;";

                    $run = mysqli_query($con, $qry);

                    if (mysqli_num_rows($run) > 0) { ?>
                        <h2>Top Topics</h2>
                        <div class="user-container" style="display: flex;flex-wrap: wrap;gap: 30px;">
                            <?php
                            $result = mysqli_query($con, $qry);
                            while ($row = mysqli_fetch_assoc($result)) {

                                $html = $row['body'];

                                if (preg_match('/<img\s+[^>]*src=["\']([^"\']+)["\']/i', $html, $matches)) {
                                    $img = $matches[1];
                                } else {
                                    $img = '../Uploads/Topic-data/default.webp';
                                }

                                ?>
                                <?php
                                if ($row['community_id'] != 0) {
                                    $search_data = '
                                    <a href="./community-topic.php?id=' . $row['topic_id'] . '" style="text-decoration: none;color: white;width: 28.45%;">
                                        <div class="e-card" style="width: 100%;height: 262px;">
                                            <img src="' . $img . '" alt="recently-searched">
                                            <div class="author">
                                                <img src="../Uploads/User-Data/' . $row['profile_image'] . '" alt="Author">
                                                <span class="username"></span>
                                                <span>' . $row['firstname'] . ' ' . $row['lastname'] . '</span>
                                            </div>
                                            <div class="title">' . $row['title'] . '</div>
                                        </div>
                                    </a>';
                                } else {
                                    $search_data = '
                                    <a href="./personal-topic.php?id=' . $row['topic_id'] . '" style="text-decoration: none;color: white;width: 28.45%;">
                                        <div class="e-card" style="width: 100%;height: 262px;">
                                            <img src="' . $img . '" alt="recently-searched">
                                            <div class="author">
                                                <img src="../Uploads/User-Data/' . $row['profile_image'] . '" alt="Author">
                                                <span class="username"></span>
                                                <span>' . $row['firstname'] . ' ' . $row['lastname'] . '</span>
                                            </div>
                                            <div class="title">' . $row['title'] . '</div>
                                        </div>
                                    </a>';
                                }
                                echo $search_data;
                            } ?>
                        </div>
                        <?php
                    } ?>
                </div>
                <div class="users-section">
                    <?php
                    $qry = "SELECT community.id,community.community_name,community.banner,community.community_logo,community.owner_id,
                            user.`username`,
                            COUNT(uc.`user_id`) AS `total_user` from community_data community
                            inner JOIN `users` user on community.`owner_id` = user.`id`
                            LEFT JOIN user_community_data uc ON `uc`.`community_id` = `community`.`id`
                            GROUP BY community.id
                            ORDER BY `total_user` DESC
                            LIMIT 4;";

                    $result = mysqli_query($con, $qry);

                    if (mysqli_num_rows($result) > 0) { ?>
                        <h2>Top Communities</h2>
                        <div class="user-container">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $community_id = $row['id'];
                                $qry = "SELECT COUNT(uc.`user_id`) AS `total_user` FROM user_community_data uc 
                                    inner JOIN `users` user on `uc`.`user_id` = `user`.`id` 
                                    inner JOIN `community_data` community on `uc`.`community_id` = `community`.`id` 
                                    WHERE `community`.`id` = $community_id;";

                                $run = mysqli_query($con, $qry);
                                $count_result = mysqli_fetch_assoc($run);
                                $user_counts = $count_result['total_user'];
                                ?>
                                <div class="e-card communities">
                                    <img src="<?php echo $row['banner']; ?>" alt="banner">
                                    <div class="author">
                                        <img src="<?php echo $row['community_logo']; ?>" alt="Author">
                                        <span style="color: white;"><?php echo $row['community_name']; ?></span>
                                        <button type="button" class="button"><a
                                                href="./community-profile.php?id=<?php echo $row['id']; ?>"
                                                style="text-decoration: none;color: white;">Visit</a></button>
                                    </div>
                                    <a href="./profile.php?id=<?php echo $row['owner_id']; ?>" class="title"
                                        style="text-decoration: none;color: #bbb6b6;">p/<?php echo $row['username']; ?></a>
                                    <div class="member"><?php echo $user_counts; ?> Members</div>
                                </div>
                                <?php
                            } ?>
                        </div>
                        <?php
                    } ?>
                </div>
                <div class="users-section">
                    <?php
                    $qry = "SELECT COUNT(topic.topic_id) as topic_count,
                    u.id,u.username,u.firstname,u.lastname,u.profile_image from `users` u
                    inner join topic_data topic on topic.user_id = u.id 
                    GROUP BY u.id
                    LIMIT 4;";

                    $result = mysqli_query($con, $qry);

                    if (mysqli_num_rows($result) > 0) { ?>
                        <h2>Top Users</h2>
                        <div class="user-container">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <a href="./profile.php?id=<?php echo $row['id']; ?>"
                                    style="text-decoration: none; color: white; width: 48%;">
                                    <div class="user-card">
                                        <div class="user-info">
                                            <img src="../Uploads/User-Data/<?php echo $row['profile_image']; ?>" alt="User">
                                            <div class="user-details">
                                                <span class="username" style="color:#e3694a;"><?php echo $row['username']; ?></span>
                                                <span><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></span>
                                            </div>
                                        </div>
                                        <div class="post-count"><img src="../Visuals/Chevron down.png" style="width: 20px;" alt="">
                                        </div>
                                    </div>
                                </a>
                                <?php
                            } ?>
                        </div>
                        <?php
                    } ?>
                </div>
                <?php
            } ?>
        </div>
    </div>
    <?php include('../Php-Scripts/popup.php'); ?>
    <script src="../Content/JS/sidebar.js"></script>
    <script src="../Content/JS/explore.js"></script>
</body>

</html>