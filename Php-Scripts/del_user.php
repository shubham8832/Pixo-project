<?php
include('../Php-Scripts/functions.php');

    $id = $_SESSION['user-details']['id']; 

    if(isset($_POST['del_user'])) {
        $qry = "DELETE FROM votes WHERE vote_user_id = $id";
        $query_run = mysqli_query($con, $qry);

        if ($query_run) {
            $qry = "DELETE FROM discuss WHERE user_id = $id";
            $query_run = mysqli_query($con, $qry);

            if($query_run){
                $qry = "DELETE FROM user_community_data WHERE user_id = $id";
                $query_run = mysqli_query($con, $qry);
    
                if($query_run){
                    $qry = "DELETE FROM topic_data WHERE user_id = $id";
                    $query_run = mysqli_query($con, $qry);
        
                    if($query_run){
                        if($query_run){
                            $qry = "DELETE FROM community_data WHERE owner_id = $id";
                            $query_run = mysqli_query($con, $qry);
                
                            if($query_run){
                                if($query_run){
                                    $qry = "DELETE FROM users WHERE id = $id";
                                    $query_run = mysqli_query($con, $qry);
                                    if($query_run){
                                        // Destroy session after successful deletion
                                        session_unset(); // Remove all session variables
                                        session_destroy(); // Destroy the session

                                        header('Location: ../pages/conupdated.php'); 
                                        exit(); // Ensure no further execution
                                    }
                                }  
                            }   
                        }       
                    }   
                }   
            }
        } else {
            die(mysqli_error($con)); 
        }
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $qry = "DELETE FROM votes WHERE vote_user_id = $id";
        $query_run = mysqli_query($con, $qry);

        if ($query_run) {
            $qry = "DELETE FROM discuss WHERE user_id = $id";
            $query_run = mysqli_query($con, $qry);

            if($query_run){
                $qry = "DELETE FROM user_community_data WHERE user_id = $id";
                $query_run = mysqli_query($con, $qry);
    
                if($query_run){
                    $qry = "DELETE FROM topic_data WHERE user_id = $id";
                    $query_run = mysqli_query($con, $qry);
        
                    if($query_run){
                        if($query_run){
                            $qry = "DELETE FROM community_data WHERE owner_id = $id";
                            $query_run = mysqli_query($con, $qry);
                
                            if($query_run){
                                if($query_run){
                                    $qry = "DELETE FROM users WHERE id = $id";
                                    $query_run = mysqli_query($con, $qry);


                                    if($query_run){
                                        $user_id = $_SESSION['user-details']['id'];
                                        header('Location: ../Pages/profile.php?id='.$user_id); 
                                        exit(); // Ensure no further execution
                                    }
                                }  
                            }   
                        }       
                    }   
                }   
            }
        } else {
            die(mysqli_error($con)); 
        }
    }

?>
