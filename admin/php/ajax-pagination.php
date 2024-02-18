<?php
    include "../../components/connect.php";
    

    $limitpp = 5;
    $page = "";
    if(isset($_POST['page_no'])){
        $page = $_POST['page_no']; 
    }else{
        $page = 1;
    }

    $offset = ($page-1)* $limitpp;


    $query = "SELECT *  FROM `users` ORDER BY `id` ASC LIMIT {$offset},{$limitpp} "; 
    $result = $conn->query($query); 
    
    $output = "";

    if ($result->rowCount() > 0)  
          { 
            $output .= " <table id='myTable'>
            <tr class='header'>
              <th style='width:25%;'>Name</th>
              <th style='width:25%;'>Email</th>
              <th style='width:20%;'>Phone</th>
              <th style='width:20%;'>Batch</th>
              <th style='width:10%;'>Action</th>
            </tr>";
              // OUTPUT DATA OF EACH ROW 
              while($row = $result->fetch(PDO::FETCH_ASSOC)) 
              { 
   
                 $output .=  "
                 <tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['batch']}</td>
                        <td>
                            <form method='post'>
                                <input type='hidden' value='{$row['id']}'  name='dlt_id'>
                                <input type='submit' value='delete' class='delete-btn' onclick='return confirm('delete this User?');' name='delete'>
                            </form>
                        </td>
                    </tr>";
                
                
                
                } 
}
      else{
          echo "<p class='empty'>No User Found</p>";
      }
    
    
      $output .= "</table>
      <center>
        <div class='pagination' id='pagination'>";

      $sql_total = "select * from users";
      $records = $conn->query($sql_total);
      $total = $records -> rowCount();
      $total_page = ceil($total/$limitpp);

      for($i=1; $i<=$total_page; $i++){
            $active = "";
            if($i == $page){
                $active = "active";
            }
            
            $output .= "<a id='{$i}' href='' class='{$active}'>{$i}</a>" ;
      }
        

      $output .= "</div></center>";

    echo $output;
   


?>