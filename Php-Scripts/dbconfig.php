<?php

        session_start();

        $server = 'localhost';
        $database = 'pixo';
        $user = 'root';
        $password = '';

    $con = mysqli_connect($server,$user,$password,$database);

    if(!$con){
        die();
    }
?>