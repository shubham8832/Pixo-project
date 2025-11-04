<?php
include('./functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['button'] == 'joinBtn') {

    $community_id = $_POST['communityId'];
    $user_id = $_POST['userId'];

    if (userCommunityExist($user_id, $community_id)) { //if it returns id then it means user has already joined this community
        $qry = "DELETE from `user_community_data` where `user_id` = $user_id && `community_id` = $community_id;";
        $run = mysqli_query($con, $qry);
        if (!$run) {
            die();
        } else {
            $response = [
                'activity' => "left",
                'msg' => $community_id . " " . $user_id,
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else { //new user
        $date = date('Y-m-d H:i:s');
        $qry = "INSERT INTO `user_community_data` (`user_id`,`community_id`,`joined_at`) VALUES($user_id,$community_id,'$date');";
        $run = mysqli_query($con, $qry);
        if (!$run) {
            die("database error: " - mysqli_error($con));
        } else {
            $response = [
                'activity' => "joined",
                'msg' => $community_id . " " . $user_id
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === "POST" && $_POST['button'] == 'edit-community') {
    $userId = $_POST['userId'];
    $communityId = $_POST['communityId'];

    $qry = "SELECT * from community_data where id = $communityId && owner_id = $userId;";
    $run = mysqli_query($con, $qry);

    if (!$run) {
        die(mysqli_error($con));
    } else {
        $result = mysqli_fetch_assoc($run);
        $response = [
            'success' => true,
            'communityId' => $result['id'],
            'communityName' => $result['community_name'],
            'banner' => $result['banner'],
            'logo' => $result['community_logo'],
            'community_bio' => $result['community_bio']
        ];


        header('Content-Type: application/json');
        echo json_encode($response);

        // header('Content-Type: application/json');
        // echo json_encode($response);
    }
}

if (isset($_POST['del-community'])) {
    $community_id = $_POST['community_id'];
    $owner = $_POST['owner_id'];

    $qry = "DELETE FROM user_community_data where community_id = $community_id;";
    $run = mysqli_query($con, $qry);

    if (!$run) {
        die(mysqli_error($con));
    } else {
        $qry = "DELETE FROM topic_data where community_id = $community_id";
        $run = mysqli_query($con, $qry);

        if (!$run) {
            die(mysqli_error($con));
        } else {
            $qry = "DELETE FROM community_data where id = $community_id && owner_id = $owner;";
            $run = mysqli_query($con, $qry);

            if (!$run) {
                die(mysqli_error($con));
            } else {
                header('location:../Pages/communities.php');
                exit();
            }
        }
    }
}

if(isset($_POST['del-user'])){
    $user_id = $_POST['user_id'];
    $community_id = $_POST['community_id'];

    $qry = "DELETE FROM user_community_data where user_id = $user_id && community_id = $community_id;";
    $run = mysqli_query($con,$qry);
    if(!$run){
        die(mysqli_error($con));
    }
    else{
        $qry = "UPDATE topic_data set community_id = 0 where user_id = $user_id && community_id = $community_id;";
        $run = mysqli_query($con,$qry);
        if(!$run){
            die(mysqli_error($con));
        }
        else{
            header('location:../Pages/community-profile.php?id='.$community_id);
        }   
    }
}

if (isset($_GET['id'])) {
    $community_id = $_GET['id'];
    $owner = $_GET['owner'];

    $qry = "DELETE FROM user_community_data where community_id = $community_id;";
    $run = mysqli_query($con, $qry);

    if (!$run) {
        die(mysqli_error($con));
    } else {
        $qry = "DELETE FROM topic_data where community_id = $community_id";
        $run = mysqli_query($con, $qry);

        if (!$run) {
            die(mysqli_error($con));
        } else {

            $qry = "DELETE FROM community_data where id = $community_id && owner_id = $owner;";
            $run = mysqli_query($con, $qry);

            if (!$run) {
                die(mysqli_error($con));
            } else {
                $url = $_GET['profile'];
                header('location:../Pages/profile.php?id=' . $url);
                exit();
            }
        }
    }
}

?>