<?php

include "../components/connect.php";

$user = $conn->prepare("SELECT * FROM `users` ");
$user->execute();

$time = time();
$videoid = $_POST['content'];
$count = 0;

$output = "";
$countText = "";

while($row = $user->fetch(PDO::FETCH_ASSOC)){
    $status = "Offline";
    if($time < $row['last_login'] && $row['last_page']==$videoid){
        $count++;
       
        $status = "Online";
        $output .= "<div class='profile-flex'><img src='uploaded_files/NaUVVr5SkVNpRX28L4NT.jpg' height='70px' width='70px' alt='profile'><h3>{$row['name']}</h3> </div>"   ; 
    }
}
$countText .= "<h2>{$count} People Are Watching</h2>";

echo $countText.$output;

?>