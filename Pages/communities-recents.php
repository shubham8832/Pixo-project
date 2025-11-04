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
    <title>Pixo | Recents</title>


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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
    <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">

    <link rel="stylesheet" href="../Content/CSS/communities.css">
    <link rel="stylesheet" href="../Content/CSS/sidebar.css">
</head>


<body>
    <div class="container-fluid content-container" style="width: 100%;margin: 0;overflow: hidden;">
        <?php include('../Php-Scripts/sidebar.php');?>

        <div class="main-content">
            <div class="upper-content">

    <div class="search-area">
        <label for="search-community"><i class="fa-solid fa-magnifying-glass"></i></label>
        <form id="search-form" method="get" style="width: 100%;display: flex;">
            <span class="e-search-bar" style="width: 100%;display: flex;align-items: center;">
                <input type="text" name="search-community" class="search-input" id="search-bar-community"
                    placeholder="Search Community in Pixo" autocomplete="off"/>
                <a href="./communities-recents.php">
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
        </form>
    </div>
    <div class="add-area" style="width: 15%;">
        <input type="button" name="btn-add-community" class="btn-add-comms open-community-btn"
            id="comm-add-btn" value="Create"   />
    </div>
            </div>
            
            <div class="container community-tab-home">
                <h3 class="heading-content">
                    Joined Communities
                </h3>
                <div class="personal-community-box" style="width: 100%;">
                    <?php
                    // Fetch all communities
                    if (isset($_GET['search-community']) && $_GET['search-community'] != '') {
                        $community_name = $_GET['search-community'];
                        $user_id = $_SESSION['user-details']['id'];

                        $qry = "SELECT DISTINCT community.id,community.community_name,community.banner,
                            user.`username` from community_data community 
                            LEFT JOIN user_community_data uc ON `uc`.`community_id` = `community`.`id`
                            LEFT JOIN `users` user on community.`owner_id` = user.`id`
                            where community.`community_name` like '%$community_name%' AND uc.user_id = $user_id
                            ORDER BY uc.joined_at DESC";?>
                        <?php
                    } else {
                        $user_id = $_SESSION['user-details']['id'];
                        $qry = "SELECT community.id,community.community_name,community.banner,
                        user.`username` from community_data community
                        LEFT JOIN user_community_data uc ON `uc`.`community_id` = `community`.`id`
                        LEFT JOIN `users` user on community.`owner_id` = user.`id`
                        where uc.`user_id` = $user_id
                        ORDER BY uc.joined_at DESC;";
                    } ?>

                    <div class="community-container">
                        <?php
                        $result = mysqli_query($con, $qry);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <a href="./community-profile.php?id=<?php echo $row['id'] ?>"
                                    style="text-decoration: none;color: white;">
                                    <div class="community-card">
                                        <img src="<?php echo $row['banner']; ?>" alt="cover-photo" width="19.97%" height="100%"
                                            style="border-radius: 12px;object-fit: cover;">
                                        <div class="community-details">
                                            <div class="title-section">
                                                <h4 class="community-name">
                                                    <?php echo htmlspecialchars($row['community_name']); ?>
                                                </h4>
                                                <img src="../Visuals/Chevron down.png" alt="" width="30px" height="30px">
                                            </div>
                                            <div class="community-info">
                                                <h3 class="owner-name">p/<?php echo htmlspecialchars($row['username']); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                        }
                        else{?>

                            <div class="aftermsg">No Communities</div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../Php-Scripts/popup.php'); ?>
    <script src="../Content/JS/sidebar.js"></script>
</body>

</html>
