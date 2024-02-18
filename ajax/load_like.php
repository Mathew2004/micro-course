<?php

    include "../components/connect.php";
    $user_id = $_COOKIE['user_id'];
    $content_id = $_POST['id'];
    $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE content_id = ?");
    $select_likes->execute([$content_id]);
    $total_likes = $select_likes->rowCount();  

    $verify_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND content_id = ?");
    $verify_likes->execute([$user_id, $content_id]);

    if($verify_likes->rowCount() > 0){
        echo "<button type='submit' name='like_content' id='like'><i class='fas fa-heart'></i><span>liked</span></button>";
     
    }else{
        echo "<button type='submit' name='like_content' id='like'><i class='far fa-heart'></i><span>liked</span></button>";
        
    }

?>