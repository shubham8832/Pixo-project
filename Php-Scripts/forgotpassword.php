<?php

include('../Php-Scripts/functions.php');
include('../Php-Scripts/mail-send.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['button'] == 'fetch-email'){
        
        $username = $_POST['user'];
        $_SESSION['forgot-pswd-credentials']['user_email'] = findEmail($username);

        if($_SESSION['forgot-pswd-credentials']['user_email'] == false){
            $response = [
                'success' => false,
                'msg' => "User does not exist kindly enter registered username ."
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else{
            $email = $_SESSION['forgot-pswd-credentials']['user_email'];
            $response = [
                'success' => true,
                'msg' => 'Our mail is ready to be send to ',
                'email' => $email
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }


    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['button'] == 'send-code'){

        $verify = rand(1000,9999);

        $type = 'otp';
        if(mailSend($_SESSION['forgot-pswd-credentials']['user_email'],$verify,$type) === 'ok'){
            $response = [
                'success' => true,
                'msg' => 'Confirmation code has been sent to '.$_SESSION['forgot-pswd-credentials']['user_email']
            ];
            
        $_SESSION['forgot-pswd-credentials']['confirm-code'] = $verify;
            
        header('Content-Type: application/json');
        echo json_encode($response);                
        }
        else{

            $response = [
                'success' => false,
                'msg' => "Something is wrong ."
            ];
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['button'] == 'resend-code'){
        $verify = rand(1000,9999);
        $type = 'otp';
        if(mailSend($_SESSION['forgot-pswd-credentials']['user_email'],$verify,$type) === 'ok'){
            $response = [
                'success' => true,
                'msg' => 'Confirmation code has been resended to'.$_SESSION['forgot-pswd-credentials']['user_email']
            ];
            
            $_SESSION['forgot-pswd-credentials']['confirm-code'] = $verify;
            
            header('Content-Type: application/json');
            echo json_encode($response); 
        }

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['button'] == 'verify-btn'){
        
        $_SESSION['attempt'] = 0;

        if($_SESSION['attempt'] > 0){
            $response = [
                'success' => false,
                'msg' => "Code expired kindly click on resend code ."
            ];
    
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else if($_POST['code'] != $_SESSION['forgot-pswd-credentials']['confirm-code']){
            $response = [
                'success' => false,
                'msg' => "Code is not correct ."
            ];

            $_SESSION['attempt'] = 1;
    
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else{
            $response = [
                'success' => true,
                'msg' => "Verified Successfully ."
            ];
    
            unset($_SESSION['attempt']);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    if(isset($_POST['confirm-pass'])){

        $filtered_mail = mysqli_escape_string($con,$_SESSION['forgot-pswd-credentials']['user_email']);
        $newPassword = $_POST['forgot-password'];
        $enc_password = mysqli_escape_string($con,$newPassword);

        // UPDATE `users` SET `password` = "aks#4504" WHERE `email` = "axarpatel029@gmail.com";
        $query = "UPDATE `users` SET `password` = '$enc_password' WHERE `email` = '$filtered_mail'";
        $run = mysqli_query($con,$query);

        unset($_SESSION['forgot-pswd-credentials']);

        if(!$run){
            die("Not working");
        }
        else{
            header("location:http://localhost/Pixo/Pages/conupdated.php?pop=true");
        }   
    }
?>