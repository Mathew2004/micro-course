<?php

include "../components/connect.php";
$user_id = $_COOKIE['user_id'];
$content_id = $_POST['id'];
$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE content_id = ?");
$select_likes->execute([$content_id]);
$total_likes = $select_likes->rowCount();  

echo "{$total_likes} Likes";

?>