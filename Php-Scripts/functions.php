<?php
include('../Php-Scripts/dbconfig.php');

    function showFormData($formField){
        if(isset($_SESSION['formdata']) && $_SESSION['formdata'] != null){
            $data = $_SESSION['formdata'];

            return $data[$formField];
        }
        else if(isset($_SESSION['userdata']) && $_SESSION['userdata'] != null){
            $data = $_SESSION['userdata'];

            return $data[$formField];
        }
        else{
            return '';
        }

    }

    //to check email or username exist in database 
    function emailExist($input_email){
        global $con;
        $query = "Select count(`email`) as `email_count` from `users` where `email` = '$input_email'";
        $run = mysqli_query($con,$query);
        $result = mysqli_fetch_assoc($run);
        return $result['email_count'];
    }

    function userExist($input_username){
        global $con;
        $query = "Select count(`username`) as `user_count` from `users` where `username` = '$input_username'";
        $run = mysqli_query($con,$query);
        $result = mysqli_fetch_assoc($run);
        return $result['user_count'];
    }

    /*to find email based on username*/
    
    function findEmail($input_username){
        global $con;
        $query = "Select `email` from `users` where `username` = '$input_username'";
        $run = mysqli_query($con,$query);
        $result = mysqli_fetch_assoc($run);
        
        if(!$result){
            return false;
        }
        return $result['email'];
    }

    function userLogin($input_username,$input_password){
        global $con;
        $query = "Select `username`,`password` from `users` where `username` = '$input_username'";
        $run = mysqli_query($con,$query);
        $result = mysqli_fetch_assoc($run);

        if($input_password == $result['password']){
            return $result['username'];
        }
        else{
            return false;
        }
    }

    /*to check user and community exist in user_community table*/
    function userCommunityExist($input_uid,$input_cid){
        global $con;
        $qry = "SELECT COUNT(`id`) as `user_join` FROM `user_community_data` where `user_id` = $input_uid && `community_id` = $input_cid;";
        $run = mysqli_query($con,$qry);

        if(!$run){
            die();
        }
        else{
            $result = mysqli_fetch_assoc($run);
            return $result['user_join'];
        }
    }

    function voteExist($input_uid,$input_tid){
        global $con;
        $qry = "SELECT `vote_type` FROM `votes` where `vote_user_id` = $input_uid && `vote_topic_id` = $input_tid;";
        $run = mysqli_query($con,$qry);

        if(!$run){
            die("Database error : " - mysqli_error($con));
        }
        else{
            if(mysqli_num_rows($run) > 0){
                $result = mysqli_fetch_assoc($run);
                return $result['vote_type'];
            }
            else{
                return false;
            }
        }
    }

    // Function to handle file uploads
    function uploadFile($inputName) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {


            $file_extension = pathinfo($_FILES[$inputName]['name'],PATHINFO_EXTENSION);
            
            $target_dir = "../Uploads/Community-Data/"; // Ensure this folder exists and has correct permissions
            $target_file = $target_dir . uniqid() .'.'. $file_extension;

            //$target_file = $target_dir . basename($_FILES[$inputName]["name"]);
            
            if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $target_file)) {
                return $target_file;
            }
        }
        // return "";
    }

?>

