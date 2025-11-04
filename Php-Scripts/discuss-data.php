<?php
include('../Php-Scripts/functions.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['userId'])){
    $userId = $_POST['userId'];
    $topic_id = $_POST['topic_id'];
    $comment_data = mysqli_escape_string( $con,htmlspecialchars($_POST['commentData']));
    $date = date('Y-m-d H:i:s');

    $qry = "INSERT INTO discuss(user_id,topic_id,content,posted_at) VALUES($userId,$topic_id,'$comment_data','$date');";
    $run = mysqli_query($con,$qry);
    if(!$run){
        die(mysqli_error($con));
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['topicId'])){

    $id = $_POST['topicId'];
    $qry = "SELECT cmnt.*,user.username,user.profile_image from discuss cmnt
     inner JOIN users user on cmnt.user_id = user.id 
     WHERE cmnt.topic_id = $id
     ORDER BY cmnt.posted_at DESC;";
    
    $run = mysqli_query($con, $qry);
    
    if (!$run) {
        die(mysqli_error($con));
    } else {
        if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_assoc($run)) { 
                if($row['user_id'] == $_SESSION['user-details']['id']){?>
                    <div class="comment-card" style="flex-direction: row-reverse;margin-left: auto;">
                        <img src="../Uploads/User-Data/<?php echo $row['profile_image'];?>" style="width: 40px;height: 35px;border-radius: 50%;object-fit: cover;" alt="">
                        <div class="comment-data" style="display: flex;flex-direction: column;width: 100%;">
                            <a href="./profile.php?id=<?php echo $row['user_id'];?>" style="text-decoration: none;color: white;">
                                <h5 class="username-id" style="color: #e3694a;font-size: 0.8rem;display: flex;justify-content: end;margin: 5px;">
                                    You
                                </h5>
                            </a>
                            <p class="comment-content" style="margin: 0;font-size: 0.8rem;width: 100%;display: flex;justify-content: flex-end;">
                                <?php echo $row['content'];?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                else{?>
                    <div class="comment-section">
                        <div class="comment-card">
                            <img src="../Uploads/User-Data/<?php echo $row['profile_image'];?>" style="width: 40px;height: 35px;border-radius: 50%;object-fit: cover;" alt="profile-img">
                            <div class="comment-data">
                                <a href="./profile.php?id=<?php echo $row['user_id'];?>" style="text-decoration: none;color: white;">
                                    <h5 class="username-id" style="color: #e3694a;font-size: 0.8rem;margin: 5px;">
                                        <?php echo $row['username'];?>
                                    </h5>
                                </a>
                                <p class="comment-content" style="margin: 0;font-size: 0.8rem;">
                                    <?php echo $row['content']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        } 
        else { ?>
            <div class="comment-section" style="width: 100%;display: flex;flex-direction: column;justify-content: center;text-align: center;">
                <img src="../Visuals/Sleeping-pillow.gif" style="width: 25%;border-radius: 12px;position: relative;left: 50%;transform: translateX(-50%);" alt="">
                <h3>No interaction ...</h3>
            </div>
            <?php
        }
    
    }

}

?>