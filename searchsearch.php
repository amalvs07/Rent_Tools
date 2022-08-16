<?php

include_once 'db_conn.php';
if (isset($_POST['search'])) {
    $search=mysqli_escape_string($conn,$_POST['search']);
   
    if (strlen($search) > 1) {
      $sql="SELECT * FROM toollist WHERE name LIKE '%$search%' ;";
      $searchitem=mysqli_query($conn,$sql);
      if (mysqli_num_rows($searchitem)==0) {
        echo"<h3>Oops... Item is not Found</h3>";
      }else{
      while ($row =mysqli_fetch_array($searchitem)) {
        $tools_id=$row['tools_id'];
        $toolname=$row['name'];
      $tooldescription=$row['description'];
      $toolimage=$row['image'];
      $toolprice=$row['price'];
     

      $element="
    
      <div class=\"card\">
       <form action=\"rental.php\" method=\"POST\">
       <img src=\"$toolimage\">
           <div class=\"content\">
               <div class=\"row\">
                   <div class=\"details\">
                       <span>$toolname</span>
                       <p>
                       $tooldescription
                       </p>
                   </div>
                   <div class=\"price\">&#36;$toolprice</div>
                   
               </div>
           
               <div class=\"buttons\">
   
                   <button class=\"cart-btn\" type=\"submit\" name=\"add\">Add to Cart</button>
                   <input type='hidden' name='t_id' value='$tools_id'>
                  
               </div>
           </div>
       </form>
   
   </div>
   ";
   echo $element;
      }}
    }
  }
     
     ?>
