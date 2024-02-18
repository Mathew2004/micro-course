<?php

include "../components/connect.php";
$id = $_COOKIE['user_id'];
echo $id;

$time = time() + 10;
$videoid = $_POST['content'];

$sql = "UPDATE users SET last_login=?, last_page=? WHERE id=?";
$stmt= $conn->prepare($sql);
$stmt->execute([$time ,$videoid,$id]);


?>