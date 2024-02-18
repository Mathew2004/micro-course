<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['delete'])){
    $delete_id = $_POST['dlt_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
 
    $verify_playlist = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
    $verify_playlist->execute([$delete_id]);
 
    if($verify_playlist->rowCount() > 0){

    $delete_playlist = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_playlist->execute([$delete_id]);
    $message[] = 'User deleted!';
    }else{
       $message[] = 'User already deleted!';
    }
 }



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; 
$query = "SELECT *  FROM `users` ORDER BY `id` ASC "; 

$result = $conn->query($query); 
$UserCount = $result->rowCount();


?>
<h1 class="btn">Total User : <?= $UserCount; ?></h1>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

<div id="table-data">

</div>
   

<style>
    #myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 95%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
  margin: 20px;
}

#myTable {
  border-collapse: collapse; /* Collapse borders */
  width: 95%;/* Full-width */
  border: 1px solid #ddd; /* Add a grey border */
  font-size: 18px; /* Increase font-size */
  margin: 20px;
}

#myTable th, #myTable td {
  text-align: left; /* Left-align text */
  padding: 12px; /* Add padding */
}

#myTable tr {
  /* Add a bottom border to all table rows */
  border-bottom: 1px solid #ddd;
  color: #fff;
}

#myTable tr.header, #myTable tr:hover {
  /* Add a grey background color to the table header and on hover */
  background-color: #f1f1f18b;
  color: #111;
}

.pagination {
  display: inline-block;
}

.pagination a {
  color: rgb(209, 201, 49);
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  font-size: 20px;
  transition: background-color .3s;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}


</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
 crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
   
        if (td) {
            console.log("HII");
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }


    $(document).ready(function(){

      function loadTable(page){
        $.ajax({
          url: 'php/ajax-pagination.php',
          type: "POST",
          data: {page_no: page},
          success: function(data){
            $("#table-data").html(data);
          }
        });
      }
      loadTable();


      $(document).on("click","#pagination a",function(e){
        e.preventDefault();
        var page_id = $(this).attr("id");
        loadTable(page_id);
      })

    });
    


    </script>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>