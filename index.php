<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body >


<?php include 'components/user_header.php'; ?>
<?php include 'components/preloader.php'; ?>


<section class="courses">

   <h1 class="heading">latest courses</h1>

   <div class="box-container">

      <?php
      /*
         $select_courses = $conn->prepare("SELECT * FROM `subject` ORDER BY date DESC ");
         //$select_courses->execute();
         if($select_courses->rowCount() > 0){
            while($fetch_sub = $select_courses->fetch(PDO::FETCH_ASSOC)){
               //$course_id = $fetch_course['id'];
                $title = $fetch_sub['title'];
*/

                  // SQL QUERY 
                $query = "SELECT *  FROM `subject` ORDER BY `id` ASC "; 

                $result = $conn->query($query); 
  
                if ($result->rowCount() > 0)  
                { 
                    // OUTPUT DATA OF EACH ROW 
                    while($row = $result->fetch(PDO::FETCH_ASSOC)) 
                    { 
                 
      ?>
      <div class="box">
        <a href="playlist.php?get_id=<?php echo $row['title'] ?>" >
            <img src="uploaded_files/<?php echo $row['img'] ?>" class="thumb" alt="">
            <h3 class="title"><?php echo $row['title'] ?></h3>
         </a>
      </div>
      <?php
           } 
        } else { 
            echo "0 results"; 
        } 
      ?>
      
     
     

   </div>

  

</section>

<!-- courses section ends -->












<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>