<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

  // $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);

   $add_playlist = $conn->prepare("INSERT INTO `notice`(title) VALUES(?)");
   $add_playlist->execute([$title]);

   //move_uploaded_file($image_tmp_name, $image_folder);

   $message[] = 'New Notice Added!';  

}

if(isset($_POST['delete'])){
    $sub_id = $_POST['id'];
    $sub_id = filter_var($sub_id, FILTER_SANITIZE_STRING);
 
    $verify_playlist = $conn->prepare("SELECT * FROM `notice` WHERE id = ? LIMIT 1");
    $verify_playlist->execute([$sub_id]);
 
    if($verify_playlist->rowCount() > 0){
 
    $delete_playlist = $conn->prepare("DELETE FROM `notice` WHERE id = ?");
    $delete_playlist->execute([$sub_id]);
    $message[] = 'Notice deleted!';
    }else{
       $message[] = 'Notice already deleted!';
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Playlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">create a Notice</h1>

   <form action="" method="post" enctype="multipart/form-data">
      
      <p>Write Notice <span>*</span></p>
      <textarea name="title" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"></textarea>
      <input type="submit" value="Add Subject" name="submit" class="btn">
   </form>

</section>


<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 90%;
  color: var(--black);
  font-size: 25px;
  margin: 10px;
}

td, th {
  border: 1px solid var(--white);
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: var(--white);
}
</style>


<table>
  <tr>
    <th>Notice</th>
    <th>Time</th>
    <th>Action</th>
  </tr>
  <?php
        $query = "SELECT *  FROM `notice` ORDER BY `id` DESC "; 

        $result = $conn->query($query); 

        if ($result->rowCount() > 0)  
        { 
            // OUTPUT DATA OF EACH ROW 
            while($row = $result->fetch(PDO::FETCH_ASSOC)) 
            { 
                ?>
  <tr>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['time']; ?></td>
    
    <td>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this video?');" name="delete">
        </form>
    </td>
  </tr>
  <?php }}?>
</table>
















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>