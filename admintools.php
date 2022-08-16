<?php

include_once 'db_conn.php';


$name='';
$price='';
$description='';
$image='';
$status='';
$update=false;
$id=0;
if (isset($_POST['save'])) {
    $name=mysqli_escape_string($conn,$_POST['name']);
    $price=mysqli_escape_string($conn,$_POST['price']);
 
    $description=mysqli_escape_string($conn,$_POST['description']);

    $stock=mysqli_escape_string($conn,$_POST['stock']);
    // $image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image=$_FILES['image'];


    //declaring variables
    // $filename = $_FILES['image']['name'];
    // $filetmpname = $_FILES['image']['tmp_name'];
    $filename=$image['name'];
  
    $fileerror=$image['error'];
    $filetmp=$image['tmp_name'];
    $fileext=explode('.',$filename);
    $filecheck=strtolower(end($fileext));
    $fileextstored=array('png','jpg','jpeg');
    if ($fileerror==0) {
         if(in_array($filecheck,$fileextstored)){
         $destinationfile='image/'.$filename;
          move_uploaded_file($filetmp,$destinationfile);

        // $folder = 'dbimages/';
         //function for saving the uploaded images in a specific folder
        // move_uploaded_file($filetmpname, $folder.$filename);
         $sql="INSERT INTO toollist (name,description,image,price)VALUES('$name',' $description','$destinationfile', '$price');";
    
         if(mysqli_query($conn,$sql)){
             print_r($name);
             print_r($description);
             print_r($price);
             $select="SELECT * FROM toollist Where name='$name' AND price='$price' ;";
             $selectquerry=mysqli_query($conn,$select);
             if (mysqli_num_rows($selectquerry) === 1) {
                $row = mysqli_fetch_assoc($selectquerry);
                if ($row['name'] === $name && $row['price'] === $price ) {
            
           
                    $toolsid  = $row['tools_id'];
                  
                }
                else{
                    echo"<script>alert('error sorrry')</script>";
                }
            }
            else{
                echo"<script>alert('error sorrry')</script>";    
            }
         
     $stocksql="INSERT INTO stocktable (tools_id,stocks)VALUES(' $toolsid','  $stock');";
     if(mysqli_query($conn,$stocksql)){
            //   $_SESSION['message']="Record has been saved";
            //   $_SESSION['msg_type']="success";
            echo"<script>alert('Record has been saved')</script>";
               header("Location:  admintools.php");
           }else{
            echo"<script>alert('Record has been not saved')</script>";
           }
        }
     

}else{
    echo"<script>alert('Exception is not valid');</script>";
    echo"<script>window.location='admintools.php';</script>";
}}
}
if (isset($_GET['delete'])) {
    $id=$_GET['delete'];
    $sql="DELETE FROM toollist WHERE tools_id=$id;";
   if( mysqli_query($conn,$sql)){
//     $_SESSION['message']="Record has been Deleted";
// $_SESSION['msg_type']="danger";
echo"<script>alert('Record has been Deleted')</script>";
header("Location:  admintools.php");
   }
}
if (isset($_GET['edit'])) {
    $id=$_GET['edit'];
    $update=true;
    $sql="SELECT * FROM toollist WHERE tools_id=$id;";
    $result=mysqli_query($conn,$sql);
    if(count($result)==1){
        $row=mysqli_fetch_array($result);
        $name=$row['name'];
        $price=$row['price'];
        $description=$row['description'];
        $status=$row['status'];
        $image=$row['image'];
        $status=$row['status'];
        
        
    }
}
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=mysqli_escape_string($conn,$_POST['name']);
    $price=mysqli_escape_string($conn,$_POST['price']);
    $description=mysqli_escape_string($conn,$_POST['description']);
    $status=mysqli_escape_string($conn,$_POST['status']);
    $image=$_FILES['image'];
    $filename=$image['name'];
  
    $fileerror=$image['error'];
    $filetmp=$image['tmp_name'];
    $fileext=explode('.',$filename);
    $filecheck=strtolower(end($fileext));
    $fileextstored=array('png','jpg','jpeg');
    if ($fileerror==0) {
    
    
    if(in_array($filecheck,$fileextstored)){
      $destinationfile='image/'.$filename;
      move_uploaded_file($filetmp,$destinationfile);
    
    
     // $folder = 'dbimages/';
     //function for saving the uploaded images in a specific folder
     // move_uploaded_file($filetmpname, $folder.$filename);
    $sql="UPDATE toollist SET name='$name', price='$price', description=' $description',image='$destinationfile',status='$status' WHERE tools_id='$id';";
    if(mysqli_query($conn,$sql)){
        // $_SESSION['message']="Record has been Updated";
        // $_SESSION['msg_type']="success";
        echo"<script>alert('Record has been Updated')</script>";
        header("Location:  admintools.php");
 
}else{
    echo"<script>alert('Exception is not valid');</script>";
    echo"<script>window.location='admintools.php';</script>";
}}
}}




















?>

<html>

<head>
<title>TOOL MODULE</title>
    <link href="css/adminmain.css" rel="stylesheet">
    <link href="css/adminuser.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/jquery-2.2.3.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <link rel="stylesheet" href="https://use.fontawsome.com/releases/v5.0.1/css/all.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <!-- <script>
        $(document).ready(function(){
            $("#click").onclick(function(){
                $.ajax({
                    url:'admininsert.php',
                    type:'post',
                    data:{statustool: $(this).val()},
                    success:function(result){
                        $(".status-results").html(result);
                    }
                });
            });
        });
    </script> -->
    <script>
        $(document).ready(function(){
            $(document).on('click','input[data-role=status]',function(){
var id=$(this).data('id');
            });
        });
    </script>
    <script>
        function setFunction(id){
            $.ajax({
                url:'admininsert.php',
                type:"POST",
                data:{statusid:$(this).val()},
                success:function(result){
                    $(".status-results").html(result);
                }
            });
        }
        
    </script>
    <script>
    

        $(function() {

            'use strict';

            var aside = $('.side-nav'),
                showAsideBtn = $('.show-side-btn'),
                contents = $('#contents'),
                _window = $(window)

            showAsideBtn.on("click", function() {
                $("#" + $(this).data('show')).toggleClass('show-side-nav');
                contents.toggleClass('margin');
            });

            if (_window.width() <= 767) {
                aside.addClass('show-side-nav');
            }

            _window.on('resize', function() {
                if ($(window).width() > 767) {
                    aside.removeClass('show-side-nav');
                }
            });

            // dropdown menu in the side nav
            var slideNavDropdown = $('.side-nav-dropdown');

            $('.side-nav .categories li').on('click', function() {

                var $this = $(this)

                $this.toggleClass('opend').siblings().removeClass('opend');

                if ($this.hasClass('opend')) {
                    $this.find('.side-nav-dropdown').slideToggle('fast');
                    $this.siblings().find('.side-nav-dropdown').slideUp('fast');
                } else {
                    $this.find('.side-nav-dropdown').slideUp('fast');
                }
            });

          
        });
    </script>
    <script>
$(document).ready(function(){
    $('#search').keyup(function(){
        search_table($(this).val());

    });
    function search_table(value){
        $('#usertable tr').each(function(){
            var found='false';
            $(this).each(function(){
                if ($(this).text().toLowerCase().indexOf(value.toLowerCase())>=0) {
                    found='true';
                }
            });
            if (found=='true') {
                $(this).show();
            }else{
                $(this).hide();
            }
        });
    }
});

    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
/* check box code */

.checkbox {
    height: 60px;
    width: 200px;
    padding: 10px;
    display: flex;
    background: #fff;
    align-items: center;
    border-radius: 5px;
    box-shadow: 5px 5px 30px rgba(0, 0, 0, .2);
    justify-content: space-between;
}

.checkbox input {
    outline: none;
    height: 20px;
    width: 70px;
    border-radius: 50px;
    -webkit-appearance: none;
    position: relative;
    background: #e6e6e6;
    box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
    transition: 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.checkbox input:checked {
    background: #db850c;
}

.checkbox input:before {
    position: absolute;
    content: "";
    left: 0;
    height: 100%;
    width: 40px;
    background: linear-gradient(#fff, #f2f2f2, #e6e6e6, #d9d9d9);
    box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
    border-radius: 50px;
    transform: scale(0.85);
    transition: left 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

input:checked:before {
    left: 30px;
}

.checkbox .text:before {
    content: "Disabled";
    font-size: 20px;
    font-weight: 500;
    color: #bfbfbf;
}

input:checked~.text:before {
    color: #cf8011;
    font-size: 20px;
    content: "Enabled";
}

</style>
<body>
<?php
 include 'adminheader.php';
?>
        <div class="welcome">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content" style="background-color: #f0ad4e !important;">
                            <h2 style="color: black;">Welcome to Tool Module</h2>
                            <p style="color: black;">Yours suggestions for our services.. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div align="center" class="search">
            <input type="text" name="search" id="search" class="search-text" placeholder="Which user details are you looking for..?" >
            <div class="icon" style="color: #f0ad4e !important;"><i class="fas fa-search"></i></div>
        </div>
        <section class="statistics">
            <div class="container-fluid">
            <div class="table-tools">
                <table id="usertable" class="table table-hover ">
                <tr>
                <th>Tool ID</th>
                        <th>Tool Image</th>
                        <th>Tool Name</th>
                        <th >Tool Price</th>
                        <th>Tool Description</th>
                        <th >Tool Status</th>
                        <th colspan="2">Action</th>
                    </tr>

                    <?php
                        $query="SELECT * FROM toollist ;";
                        $result=mysqli_query($conn,$query);
                  
                        while($row = mysqli_fetch_array($result)):?>
                    <tr id=<?php echo $row['tools_id'];?>>
                    <td>
                            <?php echo $row['tools_id'];?>
                        </td>
                        <td>
                            <?php
echo'<img src="'.$row['image'].'"/>';

?>
                        </td>
                        <td>
                            <?php echo $row['name'];?>
                        </td>
                        <td>
                            <?php echo $row['price'];?>
                        </td>
                        <td>
                            <?php echo $row['description'];?>
                        </td>
                        <td class="status-results">
                            <?php 
                           if ($row['status']==1) {
                               echo "Avaliable";
                           }
                           else{echo "Not Avalabile";}?>
                            <?php 
                            //  if($row['status']==1){echo "checked";}?>
                             <!-- <div class="checkbox"> -->
      <!-- <input type="checkbox" id="click" data-role="status" data-id=<?php
    //    echo $row['tools_id']; ?>  name="statustool"  onclick="setFunction($row['tools_id']);">
     
    </div>  -->
                        </td>
                        <td>
                            <a href="admintools.php?edit=<?php echo $row['tools_id']; ?>" class="edit">Edit</a></td>
                      
                      <td>  <a href="admintools.php?delete=<?php 
                     echo $row['tools_id']; ?>" class="delete">Delete</a></td>






                    </tr>
                    <?php endwhile; ?>


                </table>
            </div>
            <div class="form-design">
                <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <?php
if ($update == true):
?> 
                    <h2 style="color: #f0ad4e;text-align: center;margin-bottom: 40px;">UPDATE TOOLS</h2>
                    <?php 
else:?><h2 style="color: #f0ad4e;text-align: center;margin-bottom: 40px;">INSERT TOOLS</h2>
<?php 
endif;?>
                    <label>Tool Name</label>
                    <div class="field">
                        <input type="text" name="name" placeholder="Tool Name " value="<?php echo $name;?>"> 
                    </div>

                    <label>Price</label>
                    <div class="field">
                        <input type="text" name="price" placeholder="price" value="<?php echo $price;?>">
                    </div>
                    <label>Image</label>
                    <div class="field">
                        <input type="file" name="image" value="Upload" id="image">
                    </div>
                    <?php
if ($update == true):
?>   
                   <label>Status</label>
                    <div class="field">
                        <input type="text" name="status" placeholder="Status" value="<?php 
                        echo $status;?>" >
                          
                       
                    </div> 
                    <?php
                    endif;
                    ?>
                    <?php
if ($update == false):
?> 
                    <label>Stock</label>
                    <div class="field">
                        <input type="text" name="stock" placeholder="stock">

                    </div>
                    <?php
                    endif;
                    ?>
                    <label>Description</label>
                    <div class="field">
                        <input type="text" name="description" placeholder="Description" value="<?php echo $description;?>">

                    </div>
<?php
if ($update == true):
?> 
   <div class="field btn">
<div class="btn-layer"></div>
<input type="submit" value="update" name="update" id="save">
</div>
<?php 
else:?>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Save" name="save" id="save">
                    </div>
<?php 
endif;?>
                </form>
            </div>
            </div>
        </section>
 <!-- copyright parts -->
 <div class="copyrightText">
        <p>Copyright @ 2020 Rentools. All Rights Reserved.</p>
    </div>
     
    </section>

</body>

</html>