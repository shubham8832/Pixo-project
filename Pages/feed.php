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
  <title>Pixo | Feed</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lusitana:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">
  <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
  <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
  <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <link rel="stylesheet" href="../Content/CSS/feed.css">
  <link rel="stylesheet" href="../Content/CSS/sidebar.css">
</head>

<body>

  <div class="container-fluid content-container" style="width: 100%;margin: 0;overflow: hidden;">
    <?php include('../Php-Scripts/sidebar.php'); ?>
    <div class="col-md-6 col-lg-7 p-3" id="center-section" style="overflow: scroll;width: 60%;">
      <ul class="nav custom-nav">
        <li class="nav-item" id="recentBtn">
          <a class="nav-link <?php
          if (!isset($_GET['tab'])) {
            echo "active";
          } else {
            echo "";
          } ?>" href="./feed.php">Recent</a>
        </li>
        <li class="nav-item" id="trendingBtn">
          <a class="nav-link <?php
          if (isset($_GET['tab']) == 'trending') {
            echo "active";
          } else {
            echo "";
          } ?>" href="./feed.php?tab=trending">Trending</a>
        </li>
      </ul>
      <div class="mt-4 input-box">
        <span class="me-2">
          <img src="../Uploads/User-Data/<?php echo $_SESSION['user-details']['profile_image']; ?>"
            class="rounded-circle" alt="User Icon" style="width: 40px;height: 40px;object-fit: cover;">
        </span>
        <input type="text" placeholder="What's on your mind?" id="add-topic-text" style="height: 40px;cursor: pointer;">
        <span class="add-icon">+</span>
      </div>
      <?php

      $qry = 'SELECT 
        (SELECT COALESCE(SUM(vote.`vote_type`),0) FROM votes vote
        WHERE vote.vote_topic_id = topic.topic_id) as `total_votes`,
        COUNT(DISTINCT cmnt.`id`) as `total_cmnts`,
        topic.*,
        user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic 
        INNER JOIN `users` user ON topic.`user_id` = user.`id` 
        left JOIN discuss cmnt on cmnt.topic_id = topic.topic_id 
        LEFT JOIN votes vote on vote.`vote_topic_id` = `topic`.`topic_id` 
        GROUP BY topic.`topic_id` 
        ORDER BY topic.`created_at` DESC';

      if (isset($_GET['tab']) == 'trending') {
        $qry = 'SELECT 
           (SELECT COALESCE(SUM(vote.`vote_type`),0) FROM votes vote
           WHERE vote.vote_topic_id = topic.topic_id) as `total_votes`,
           COUNT(DISTINCT cmnt.`id`) as `total_cmnts`,
           topic.*,
           user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic 
           INNER JOIN `users` user ON topic.`user_id` = user.`id` 
           LEFT JOIN votes vote on vote.`vote_topic_id` = `topic`.`topic_id` 
           left JOIN discuss cmnt on cmnt.topic_id = topic.topic_id
           GROUP BY topic.`topic_id`
           ORDER BY `total_votes` DESC';
      } else if (isset($_GET['search'])) {
        $search = trim($_GET['search']);
        $qry = "SELECT 
          (SELECT COALESCE(SUM(vote.`vote_type`),0) FROM votes vote
          WHERE vote.vote_topic_id = topic.topic_id) as `total_votes`,
          topic.*,
          COUNT(DISTINCT cmnt.`id`) as `total_cmnts`,
          user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic 
          INNER JOIN `users` user ON topic.`user_id` = user.`id` 
          left JOIN discuss cmnt on cmnt.topic_id = topic.topic_id 
          LEFT JOIN votes vote on vote.`vote_topic_id` = `topic`.`topic_id` 
          WHERE topic.`title` like '%$search%' 
          GROUP BY topic.`topic_id` 
          ORDER BY topic.`created_at` DESC";
      }
      // $qry = 'SELECT topic.*,user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic
      //  INNER JOIN `users` user ON topic.`user_id` = user.`id` 
      //  ORDER BY topic.`created_at` DESC';
      $run = mysqli_query($con, $qry);

      if (!$run) {
        die();
      } else {
        if (mysqli_num_rows($run) > 0) {
          while ($row = mysqli_fetch_assoc($run)) { ?>
            <div class="contain" style="position: relative;display: flex;flex-direction: column;justify-content: center;">
              <div class="card card-custom" style="padding: 0;">
                <div class="card-body" style="width: 100%;">
                  <div class="d-flex align-items-center mb-3" style="width: 100%;color: white;">
                    <img src="<?php echo "../Uploads/User-Data/" . $row['profile_image']; ?>" alt="profile"
                      class="profile-pic" style="object-fit: cover;">
                    <div class="ms-2" style="width: 100%;">
                      <strong style="display: flex;align-items: center;">
                        <div style="flex-grow: 1;"><?php echo $row['firstname'] . " " . $row['lastname']; ?></div>
                        <?php
                        $loggedInUserId = $_SESSION['user-details']['id'];
                        $topic_owner = $row['id'];
                        if ($topic_owner != $loggedInUserId) { ?>
                          <i class="fas fa-ellipsis-v icon" style="color: whitesmoke;cursor: pointer;"></i>
                          <?php
                        }
                        ?>
                      </strong>
                      <div style="width: 100%;display: flex;flex-grow: 1;">
                        <a class="small-text"
                          href="./profile.php?id=<?php echo $row['id']; ?>">p/<?php echo $row['username'] ?></a>
                        <span class="date"><?php
                        $format_date = date("d-M-Y", strtotime($row['created_at']));
                        echo $format_date;
                        ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="heading">
                    <h3 style="color: white;margin-bottom:2rem;"><strong><?php echo $row['title']; ?></strong></h3>
                  </div>
                  <div class="content" style="color: white;margin-bottom:15px;display: none;"
                    id="content-<?php echo $row['topic_id']; ?>">
                    <?php echo $row['body']; ?>
                  </div>
                  <a href="#" id="toggle-<?php echo $row['topic_id']; ?>"
                    onclick="toggleData(<?php echo $row['topic_id']; ?>)"
                    style="color: white;text-decoration: none;display: flex;justify-content: center;gap: 10px;margin-bottom: 10px;">Show
                    More <span style="transform: rotate(-90deg)" ;>&lt;</span></a>

                  <div class="d-flex align-items-center" style="gap: 10px;height: 40px;color: white;">
                    <div class="votes">
                      <button id="btn-up-vote" onclick="vote(<?php echo $row['topic_id']; ?>,event)" data-type="+1"
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
                        ?>" id="up-arrow-<?php echo $row['topic_id']; ?>" style="transform: rotate(90deg);">&lt;</p>
                      </button>
                      <p class="count" style="font-size: 1.1rem;width: 30px;text-align: center;"
                        id="vote-count-<?php echo $row['topic_id']; ?>"><?php echo $row['total_votes']; ?></p>
                      <button id="btn-up-vote" onclick="vote(<?php echo $row['topic_id']; ?>,event)" data-type="-1"
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
                        ?>" id="down-arrow-<?php echo $row['topic_id']; ?>" style="transform: rotate(-90deg)" ;>&lt;
                        </p>
                      </button>
                    </div>
                    <?php
                    if ($row['community_id'] != 0) { ?>
                      <a href="./community-topic.php?id=<?php echo $row['topic_id']; ?>"
                        style="text-decoration: none;color: white;flex-grow: 50;">
                        <div class="discuss">
                          <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                            stroke="#000000" stroke-width="0.00025">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                              <path
                                d="M9.0001 8.517C8.58589 8.517 8.2501 8.85279 8.2501 9.267C8.2501 9.68121 8.58589 10.017 9.0001 10.017V8.517ZM16.0001 10.017C16.4143 10.017 16.7501 9.68121 16.7501 9.267C16.7501 8.85279 16.4143 8.517 16.0001 8.517V10.017ZM9.8751 11.076C9.46089 11.076 9.1251 11.4118 9.1251 11.826C9.1251 12.2402 9.46089 12.576 9.8751 12.576V11.076ZM15.1251 12.576C15.5393 12.576 15.8751 12.2402 15.8751 11.826C15.8751 11.4118 15.5393 11.076 15.1251 11.076V12.576ZM9.1631 5V4.24998L9.15763 4.25002L9.1631 5ZM15.8381 5L15.8438 4.25H15.8381V5ZM19.5001 8.717L18.7501 8.71149V8.717H19.5001ZM19.5001 13.23H18.7501L18.7501 13.2355L19.5001 13.23ZM18.4384 15.8472L17.9042 15.3207L17.9042 15.3207L18.4384 15.8472ZM15.8371 16.947V17.697L15.8426 17.697L15.8371 16.947ZM9.1631 16.947V16.197C9.03469 16.197 8.90843 16.23 8.79641 16.2928L9.1631 16.947ZM5.5001 19H4.7501C4.7501 19.2662 4.89125 19.5125 5.12097 19.6471C5.35068 19.7817 5.63454 19.7844 5.86679 19.6542L5.5001 19ZM5.5001 8.717H6.25012L6.25008 8.71149L5.5001 8.717ZM6.56175 6.09984L6.02756 5.5734H6.02756L6.56175 6.09984ZM9.0001 10.017H16.0001V8.517H9.0001V10.017ZM9.8751 12.576H15.1251V11.076H9.8751V12.576ZM9.1631 5.75H15.8381V4.25H9.1631V5.75ZM15.8324 5.74998C17.4559 5.76225 18.762 7.08806 18.7501 8.71149L20.2501 8.72251C20.2681 6.2708 18.2955 4.26856 15.8438 4.25002L15.8324 5.74998ZM18.7501 8.717V13.23H20.2501V8.717H18.7501ZM18.7501 13.2355C18.7558 14.0153 18.4516 14.7653 17.9042 15.3207L18.9726 16.3736C19.7992 15.5348 20.2587 14.4021 20.2501 13.2245L18.7501 13.2355ZM17.9042 15.3207C17.3569 15.8761 16.6114 16.1913 15.8316 16.197L15.8426 17.697C17.0201 17.6884 18.1461 17.2124 18.9726 16.3736L17.9042 15.3207ZM15.8371 16.197H9.1631V17.697H15.8371V16.197ZM8.79641 16.2928L5.13341 18.3458L5.86679 19.6542L9.52979 17.6012L8.79641 16.2928ZM6.2501 19V8.717H4.7501V19H6.2501ZM6.25008 8.71149C6.24435 7.93175 6.54862 7.18167 7.09595 6.62627L6.02756 5.5734C5.20098 6.41216 4.74147 7.54494 4.75012 8.72251L6.25008 8.71149ZM7.09595 6.62627C7.64328 6.07088 8.38882 5.75566 9.16857 5.74998L9.15763 4.25002C7.98006 4.2586 6.85413 4.73464 6.02756 5.5734L7.09595 6.62627Z"
                                fill="#ffffff"></path>
                            </g>
                          </svg>
                          <p class="count" id="comments" style="margin: 0;"><?php echo $row['total_cmnts']; ?></p>
                        </div>
                      </a>
                      <a href="./community-profile.php?id=<?php echo $row['community_id']; ?>"
                        style="text-decoration: none;color: white;">
                        <i class="fa-solid fa-circle-plus" style="color: #e3694a;"></i>
                        <span class="small-text" id="community">View Community</span>
                      </a>
                      <?php
                    } else { ?>
                      <a href="./personal-topic.php?id=<?php echo $row['topic_id']; ?>"
                        style="text-decoration: none;color: white;flex-grow: 50;">
                        <div class="discuss">
                          <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                            stroke="#000000" stroke-width="0.00025">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                              <path
                                d="M9.0001 8.517C8.58589 8.517 8.2501 8.85279 8.2501 9.267C8.2501 9.68121 8.58589 10.017 9.0001 10.017V8.517ZM16.0001 10.017C16.4143 10.017 16.7501 9.68121 16.7501 9.267C16.7501 8.85279 16.4143 8.517 16.0001 8.517V10.017ZM9.8751 11.076C9.46089 11.076 9.1251 11.4118 9.1251 11.826C9.1251 12.2402 9.46089 12.576 9.8751 12.576V11.076ZM15.1251 12.576C15.5393 12.576 15.8751 12.2402 15.8751 11.826C15.8751 11.4118 15.5393 11.076 15.1251 11.076V12.576ZM9.1631 5V4.24998L9.15763 4.25002L9.1631 5ZM15.8381 5L15.8438 4.25H15.8381V5ZM19.5001 8.717L18.7501 8.71149V8.717H19.5001ZM19.5001 13.23H18.7501L18.7501 13.2355L19.5001 13.23ZM18.4384 15.8472L17.9042 15.3207L17.9042 15.3207L18.4384 15.8472ZM15.8371 16.947V17.697L15.8426 17.697L15.8371 16.947ZM9.1631 16.947V16.197C9.03469 16.197 8.90843 16.23 8.79641 16.2928L9.1631 16.947ZM5.5001 19H4.7501C4.7501 19.2662 4.89125 19.5125 5.12097 19.6471C5.35068 19.7817 5.63454 19.7844 5.86679 19.6542L5.5001 19ZM5.5001 8.717H6.25012L6.25008 8.71149L5.5001 8.717ZM6.56175 6.09984L6.02756 5.5734H6.02756L6.56175 6.09984ZM9.0001 10.017H16.0001V8.517H9.0001V10.017ZM9.8751 12.576H15.1251V11.076H9.8751V12.576ZM9.1631 5.75H15.8381V4.25H9.1631V5.75ZM15.8324 5.74998C17.4559 5.76225 18.762 7.08806 18.7501 8.71149L20.2501 8.72251C20.2681 6.2708 18.2955 4.26856 15.8438 4.25002L15.8324 5.74998ZM18.7501 8.717V13.23H20.2501V8.717H18.7501ZM18.7501 13.2355C18.7558 14.0153 18.4516 14.7653 17.9042 15.3207L18.9726 16.3736C19.7992 15.5348 20.2587 14.4021 20.2501 13.2245L18.7501 13.2355ZM17.9042 15.3207C17.3569 15.8761 16.6114 16.1913 15.8316 16.197L15.8426 17.697C17.0201 17.6884 18.1461 17.2124 18.9726 16.3736L17.9042 15.3207ZM15.8371 16.197H9.1631V17.697H15.8371V16.197ZM8.79641 16.2928L5.13341 18.3458L5.86679 19.6542L9.52979 17.6012L8.79641 16.2928ZM6.2501 19V8.717H4.7501V19H6.2501ZM6.25008 8.71149C6.24435 7.93175 6.54862 7.18167 7.09595 6.62627L6.02756 5.5734C5.20098 6.41216 4.74147 7.54494 4.75012 8.72251L6.25008 8.71149ZM7.09595 6.62627C7.64328 6.07088 8.38882 5.75566 9.16857 5.74998L9.15763 4.25002C7.98006 4.2586 6.85413 4.73464 6.02756 5.5734L7.09595 6.62627Z"
                                fill="#ffffff"></path>
                            </g>
                          </svg>
                          <p class="count" id="comments" style="margin: 0;"><?php echo $row['total_cmnts']; ?></p>
                        </div>
                      </a>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <?php
              $loggedInUserId = $_SESSION['user-details']['id'];
              $topic_owner = $row['id'];
              if ($topic_owner != $loggedInUserId) { ?>
                <div class="buttons" id="buttons">
                  <button name="report-btn" class="report-btn" id="report-btn">Report</button>
                </div>
                <!-- Popup for Report -->
                <div class="popupReport" id="popupReport">
                  <div class="popup-content">
                    <button class="close-btn">&times;</button>
                    <h4 class="pop-head">Why are you reporting this topic?</h4>
                    <p class="description">Your report is anonymous . Others <br> will not be notified about it.</p>
                    <form action="../Php-Scripts/update_report.php" id="report-form" method="post">
                      <input type="hidden" name="redirection" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                      <input type="hidden" name="topic_id" value="<?php echo $row['topic_id']; ?>">
                      <button type="submit" class="content" name="report-btn" value="1">Bullying or unwanted content</button>
                      <button type="submit" class="content" name="report-btn" value="2">Violence , Hate or Exploitation</button>
                      <button type="submit" class="content" name="report-btn" value="3">Selling or promoting restricted
                        items</button>
                      <button type="submit" class="content" name="report-btn" value="4">Nudity or Sexual Activity</button>
                      <button type="submit" class="content" name="report-btn" value="5">Scam , Fraud or spam</button>
                      <button type="submit" class="content" name="report-btn" value="6">False Information</button>
                    </form>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
            <hr style="margin: 10px 0px 10px 0px;">
            <?php
          }
        } else { ?>
          <div class="card card-custom"
            style="height: 510px;color: white;display: flex;align-items: center;justify-content: center;font-size: 1.5rem;">
            No Content Currently</div>
          <?php
        }
      } ?>
    </div>

    <!-- Trending Section -->
    <div class="col-md-4 col-lg-3" style="margin: 0rem 1rem;width: 22.96%;">
      <div class="right-panel" style="width: 100%;">
        <div class="search-bar">
          <div class="search-icon"></div>
          <form action="./feed.php" method="get" id="searchform">
            <input type="text" autocomplete="off" name="search" placeholder="Search Pixo">
          </form>
        </div>

        <div style="display: flex;width: 100%;margin: 1.2rem 0rem;align-items: center;">
          <span id="title">Currently in Trend</span>
          <i class="fa-solid fa-circle-chevron-down" id="arrow"></i>
        </div>

        <!-- Trending Item 1 -->
        <div class="trending-topic" style="height: calc(100vh - 140px); overflow-y: scroll;">
          <?php
          $qry = 'SELECT COALESCE(SUM(vote.`vote_type`),0) as `total_votes`,topic.*,
            user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic 
            INNER JOIN `users` user ON topic.`user_id` = user.`id` 
            LEFT JOIN votes vote on vote.`vote_topic_id` = `topic`.`topic_id` 
            GROUP BY topic.`topic_id` 
            ORDER BY COALESCE(SUM(vote.`vote_type`),0) DESC;';

          $run = mysqli_query($con, $qry);

          if (!$run) {
            die();
          } else {
            $i = 0;
            while ($row = mysqli_fetch_assoc($run)) {
              $i += 1;
              if ($i <= 3) {
                $html = $row['body'];

                if (preg_match('/<img\s+[^>]*src=["\']([^"\']+)["\']/i', $html, $matches)) {
                  $img = $matches[1];
                } else {
                  $img = '../Uploads/Topic-data/default.webp';
                }

                $trending_data = '
                <a href="./community-topic.php?id=' . $row['topic_id'] . '" style="text-decoration: none;color: white;">
                  <div class="trending-panel">
                    <span class="trending-item">
                      <div style="flex-grow: 1;width: 65%">
                        <span class="trending-title">' . $row['title'] . '</span><br>
                        <span class="trending-rank">Trending #' . $i . '</span>
                      </div>
                      
                      <div style="width: 35%;">
                        <img src="' . $img . '" alt="Post Image">
                      </div>
                    </span>
                    <a href="./profile.php?id=' . $row['user_id'] . '" style="text-decoration: none;color: white;">
                      <div class="name">
                        <img src="../Uploads/User-Data/' . $row['profile_image'] . '" alt="Profile Picture" style="object-fit: cover;">
                        <div class="user-name" style="flex-grow: 1;">
                          ' . $row['firstname'] . ' ' . $row['lastname'] . '
                        </div>
                        <i class="fa-solid fa-circle-chevron-right" id="right-arrow"></i>
                      </div>
                    </a>
                    <hr>
                  </div>
                </a>
                ';
                echo $trending_data;
              }
            }
          }
          ?>
        </div>
      </div>
    </div>
    <?php
    if (isset($_SESSION['report']) && $_SESSION['report'] == true) { ?>
      <script>
        toastr.success("Reported Successfully.", "Pixo | Notification", { timeout: 4000 });
      </script>
      <?php
      unset($_SESSION['report']);
    }
    ?>
    <?php
    if (isset($_SESSION['reported']) && $_SESSION['reported'] = true) { ?>
      <script>
        toastr.error("You have already reported.", "Pixo | Notification", { timeout: 4000 });
      </script>
      <?php
      unset($_SESSION['reported']);
    }
    ?>

  </div>
  <?php include('../Php-Scripts/popup.php'); ?>
  <script src="../Content/JS/sidebar.js"></script>
  <script src="../Content/JS/feed.js"></script>
  <script src="../Content/JS/vote.js"></script>

</body>

</html>