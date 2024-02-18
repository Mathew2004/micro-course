<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['g-recaptcha-response'])){


   $secretKey = '6LdxCF8pAAAAALn9c2RFHCWQgQ-sH-T0oSBmEItB';
   $ip = $_SERVER['REMOTE_ADDR'];
   $response = $_POST['g-recaptcha-response'];
   $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$ip";
   $fire = file_get_contents($url);
   $data = json_decode($fire);

   if($data->success == true){
      if(isset($_POST['submit'])){

         $id = unique_id();
         $name = $_POST['name'];
         $name = filter_var($name, FILTER_SANITIZE_STRING);
         $email = $_POST['email'];
         $email = filter_var($email, FILTER_SANITIZE_STRING);
         $phone = $_POST['phone'];
         $phone = filter_var($phone, FILTER_SANITIZE_STRING);
         $batch = $_POST['batch'];
         $batch = filter_var($batch, FILTER_SANITIZE_STRING);
         $pass = sha1($_POST['pass']);
         $pass = filter_var($pass, FILTER_SANITIZE_STRING);
         $cpass = sha1($_POST['cpass']);
         $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

         
      
      
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
         $select_user->execute([$email]);
         
         if($select_user->rowCount() > 0){
            $message[] = 'email already taken!';
         }else{
            if($pass != $cpass){
               $message[] = 'confirm passowrd not matched!';
            }else{
               $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, phone, batch, password) VALUES(?,?,?,?,?,?)");
               $insert_user->execute([$id, $name, $email,$phone,$batch, $cpass]);
            //  move_uploaded_file($image_tmp_name, $image_folder);
               
               $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
               $verify_user->execute([$email, $pass]);
               $row = $verify_user->fetch(PDO::FETCH_ASSOC);
               
               if($verify_user->rowCount() > 0){
                  setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
                  header('location:index');
               }
            }
         }
      
      }
   }
   else{
      $message[] = 'Please fill the Captcha';
   }




}






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
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form class="register" action="" method="POST" enctype="multipart/form-data">
      <h3>create account</h3>
      <div class="flex">
         <div class="col">
            <p>Name <span>*</span></p>
            <input type="text" name="name" placeholder="eneter your name" maxlength="100" required class="box" autocomplete="off">
            <p>Email <span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" maxlength="120" required class="box"  autocomplete="off">
            <p>Phone Number <span>*</span></p>
            <input type="tel" name="phone" placeholder="enter your phone number" maxlength="20" required class="box"  autocomplete="off">
            
         </div>
         <div class="col">
            <p>Batch <span>*</span></p>
            <select name="batch" class="box" required>
                  <option value="" selected disabled>-- Select Batch</option>
                  <option value="HSC 2024" >HSC 2024</option>
                  <option value="HSC 2025" >HSC 2025</option>
                  <option value="HSC 2026" >HSC 2026</option>
            </select>
            <p>your password <span>*</span></p>
            <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box"  autocomplete="off">
            <p>confirm password <span>*</span></p>
            <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box"  autocomplete="off"> <br>
            <div class="g-recaptcha" data-sitekey="6LdxCF8pAAAAAGk_-oEaxTuwA4DifrKNNMKv5W9B" ></div> <br>
         </div>
      </div>
      
      <p class="link">already have an account? <a href="login">login now</a></p>
      <input type="submit" name="submit" id="reg" value="register now" class="btn">
   </form>

</section>











<?php include 'components/footer.php'; ?>


<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>
   /*
   $(document).on('click','#reg', function(){
      var response = grecaptcha.getResponse();
      
      if(response.length == 0){
         alert("Please Solve Recaptcha");
      }



   })
*/

 </script>
   
</body>
</html>