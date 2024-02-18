<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['delete_sub'])){
   $sub_id = $_POST['sub_id'];
   $sub_id = filter_var($sub_id, FILTER_SANITIZE_STRING);

   $verify_playlist = $conn->prepare("SELECT * FROM `subject` WHERE id = ? LIMIT 1");
   $verify_playlist->execute([$sub_id]);

   if($verify_playlist->rowCount() > 0){

   

   $delete_playlist_thumb = $conn->prepare("SELECT * FROM `subject` WHERE id = ? LIMIT 1");
   $delete_playlist_thumb->execute([$sub_id]);
   $fetch_thumb = $delete_playlist_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['img']);
   //$delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE playlist_id = ?");
   //$delete_bookmark->execute([$delete_id]);
   $delete_playlist = $conn->prepare("DELETE FROM `subject` WHERE id = ?");
   $delete_playlist->execute([$sub_id]);
   $message[] = 'Subject deleted!';
   }else{
      $message[] = 'Subject already deleted!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Playlists</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlists">

   <h1 class="heading">added subjects</h1>

   <div class="box-container">
   
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">add new subject</h3>
         <a href="add_sub.php" class="btn">add subject</a>
      </div>

      <?php
         $query = "SELECT *  FROM `subject`"; 

         $result = $conn->query($query); 

         if ($result->rowCount() > 0)  
         { 
             // OUTPUT DATA OF EACH ROW 
             while($row = $result->fetch(PDO::FETCH_ASSOC)) 
             { 
      ?>
      <div class="box">
        
         <div class="thumb">
            
            <img src="../uploaded_files/<?php echo $row['img']; ?>" alt="">
         </div>
         <h3 class="title"><?php echo $row['title']; ?></h3>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="sub_id" value="<?php echo $row['id']; ?>">
            <a href="update_content.php?get_id=<?php echo $row['id']; ?>" class="option-btn">update</a>
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this video?');" name="delete_sub">
         </form>
         
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">no playlist added yet!</p>';
      }
      ?>

   </div>

</section>













<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

</body>
</html>