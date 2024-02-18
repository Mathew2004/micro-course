<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:dashboard.php');
}

if(isset($_POST['submit'])){

   $video_id = $_POST['video_id'];
   $video_id = filter_var($video_id, FILTER_SANITIZE_STRING);
   $video = $_POST['video'];
   $video = filter_var($video, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $playlist = $_POST['playlist'];
   $playlist = filter_var($playlist, FILTER_SANITIZE_STRING);

   $update_content = $conn->prepare("UPDATE `content` SET title = ?, description = ?, status = ? WHERE id = ?");
   $update_content->execute([$title, $description, $status, $video_id]);

   if(!empty($playlist)){
      $update_playlist = $conn->prepare("UPDATE `content` SET playlist_id = ? WHERE id = ?");
      $update_playlist->execute([$playlist, $video_id]);
   }
/*
   $old_thumb = $_POST['old_thumb'];
   $old_thumb = filter_var($old_thumb, FILTER_SANITIZE_STRING);
   $thumb = $_FILES['thumb']['name'];
   $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
   $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
   $rename_thumb = unique_id().'.'.$thumb_ext;
   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../uploaded_files/'.$rename_thumb;
*/
   $img = $_POST['img'];
   $img = filter_var($img, FILTER_SANITIZE_STRING);
   if(!empty($img)){
     
         $update_thumb = $conn->prepare("UPDATE `content` SET thumb = ? WHERE id = ?");
         $update_thumb->execute([$img, $video_id]);

      }
   $ls = $_POST['ls'];
   $ls = filter_var($ls, FILTER_SANITIZE_STRING);
   if(!empty($ls)){
     
         $update_thumb = $conn->prepare("UPDATE `content` SET lecsheet = ? WHERE id = ?");
         $update_thumb->execute([$ls, $video_id]);

      }
   



   $video = $_POST['video'];
   $video = filter_var($video, FILTER_SANITIZE_STRING);
  
   if(!empty($video)){
      $update_video = $conn->prepare("UPDATE `content` SET video = ? WHERE id = ?");
      $update_video->execute([$video, $video_id]);
      //move_uploaded_file($video_tmp_name, $video_folder);
     // if($old_video != '' AND $old_video != $rename_video){
       //  unlink('../uploaded_files/'.$old_video);
      //}
   }

   $message[] = 'content updated!';

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update video</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="video-form">

   <h1 class="heading">update content</h1>

   <?php
      $select_videos = $conn->prepare("SELECT * FROM `content` WHERE id = ? AND tutor_id = ?");
      $select_videos->execute([$get_id, $tutor_id]);
      if($select_videos->rowCount() > 0){
         while($fecth_videos = $select_videos->fetch(PDO::FETCH_ASSOC)){ 
            $video_id = $fecth_videos['id'];
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="video_id" value="<?= $fecth_videos['id']; ?>">
      <input type="hidden" name="old_thumb" value="<?= $fecth_videos['thumb']; ?>">
      <input type="hidden" name="old_video" value="<?= $fecth_videos['video']; ?>">
      <p>update status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="<?= $fecth_videos['status']; ?>" selected><?= $fecth_videos['status']; ?></option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>update title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="enter video title" class="box" value="<?= $fecth_videos['title']; ?>">
      <p>update description <span>*</span></p>
      <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fecth_videos['description']; ?></textarea>
      <p>update playlist</p>
      <select name="playlist" class="box">
         <option value="<?= $fecth_videos['playlist_id']; ?>" selected>--select playlist</option>
         <?php
         $select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
         $select_playlists->execute([$tutor_id]);
         if($select_playlists->rowCount() > 0){
            while($fetch_playlist = $select_playlists->fetch(PDO::FETCH_ASSOC)){
         ?>
         <option value="<?= $fetch_playlist['id']; ?>"><?= $fetch_playlist['title']; ?></option>
         <?php
            }
         ?>
         <?php
         }else{
            echo '<option value="" disabled>no playlist created yet!</option>';
         }
         ?>
      </select>
      <p>Upload img in <a href="https://postimg.cc/" target="blank" style="cursor:pointer;">https://postimg.cc/</a> and embed direct link <span>*</span></p>
      <input type="text" name="img" maxlength="500" value="<?= $fecth_videos['thumb']; ?>" required placeholder="ex. https://i.postimg.cc/J04d4n55/hqdefault.webp" class="box">
      <p>Lecture Sheet <span>*</span></p>
      <input type="text" name="ls" maxlength="500" value="<?= $fecth_videos['lecsheet']; ?>" required placeholder="Enter Lecture Sheet Link" class="box">
      <p>Youtube ID <span>*</span></p>
      <input type="text" name="video" maxlength="500" value="<?= $fecth_videos['video']; ?>" required placeholder="Enter YT video id" class="box">
      <input type="submit" name="submit" value="Submit" class="btn">
     
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">video not found! <a href="add_content.php" class="btn" style="margin-top: 1.5rem;">add videos</a></p>';
      }
   ?>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>