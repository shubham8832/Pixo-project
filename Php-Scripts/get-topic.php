<?php
include('../Php-Scripts/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['button'] == 'btn-edit'){
    $userId = $_POST['userId'];
    $topicId = $_POST['topicId'];

    $qry = "SELECT * from topic_data where topic_id = $topicId && user_id = $userId;";
    $run = mysqli_query($con,$qry);
    if(!$run){
        die(mysqli_error($con));
    }
    else{

        $result = mysqli_fetch_assoc($run);
        $response = [
            'success' => true,
            'topic_id' => $result['topic_id'],
            'title' => $result['title'],
            'body' => $result['body'],
            'user_id' => $result['user_id'],
            'categories' => $result['categories'],
            'community_id' => $result['community_id']
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

?>