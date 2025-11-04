<?php
include('../Php-Scripts/functions.php');


 if (isset($_POST['create_community'])) {  
    $community_name = mysqli_real_escape_string($con, $_POST['community_name']);
    // $owner_id = $_SESSION['user_id']; 
    $created_at = date('Y-m-d H:i:s');
    $owner_id = $_SESSION['user-details']['id'];
    $community_bio = mysqli_real_escape_string($con,$_POST['community-bio']);

    // Handle file uploads
    $banner_path = uploadFile('banner');
    $community_logo_path = uploadFile('community_logo');

    $insertQuery = "INSERT INTO community_data (community_name, banner, community_logo, community_bio, owner_id, created_at) 
                    VALUES ('$community_name', '$banner_path', '$community_logo_path', '$community_bio', '$owner_id', '$created_at')";

    $run = mysqli_query($con,$insertQuery);
    if ($run) {
        $insertQuery = "SELECT id from community_data where owner_id = $owner_id && community_name = '$community_name'";
        if($run = mysqli_query($con,$insertQuery)){
            $result = mysqli_fetch_assoc($run);
            $community_id = $result['id'];
            $date = date('Y-m-d H:i:s');
    
            $insertQuery = "INSERT INTO user_community_data(user_id,community_id,joined_at) VALUES($owner_id,$community_id,'$date');";
            if(mysqli_query($con,$insertQuery)){
                header('location:../Pages/communities.php');
            }
            else{
                echo "Error inserting data: " . mysqli_error($con);
            }
        }
    } else {
        echo "Error inserting data: " . mysqli_error($con);
    }
}

    if(isset($_POST['edit-community'])){
        $community_name = mysqli_real_escape_string($con, $_POST['community_name']);
        // $owner_id = $_SESSION['user_id']; 
        $created_at = date('Y-m-d H:i:s');
        $community_id = $_POST['community_id'];
        $community_bio = mysqli_real_escape_string($con,$_POST['community-bio']);
        
        //handle file uploads
        $old_banner = $_POST['old-banner'];
        $old_logo = $_POST['old-logo'];

        $new_banner = $_FILES['banner']['name'];
        $new_logo = $_FILES['community_logo']['name'];

        if($new_banner != ''){
            $banner_path = uploadFile('banner');    
        }
        else{
            $banner_path = $old_banner;
        }
        if($new_logo != ''){
            $community_logo_path = uploadFile('community_logo');
        }
        else{
            $community_logo_path = $old_logo;
        }

        $qry = "UPDATE community_data set community_name = '$community_name',banner = '$banner_path',
        community_logo = '$community_logo_path',community_bio = '$community_bio' where id = $community_id;";

        $run = mysqli_query($con,$qry);
        if(!$run){
            die(mysqli_error($con));
        }
        else{
            header('location:../Pages/community-profile.php?id='.$community_id);
        }


        //$insertQuery = "INSERT INTO community_data (community_name, banner, community_logo, community_bio, owner_id, created_at) 
        //               VALUES ('$community_name', '$banner_path', '$community_logo_path', '$community_bio', '$owner_id', '$created_at')";

    }

?>
