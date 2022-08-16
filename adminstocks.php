<?php
session_start();
include_once 'db_conn.php';
$toolid='';
$stock='';
$status='';
$update=false;
$stockid=0;
if (isset($_POST['stocksave'])) {
    $toolsid=mysqli_escape_string($conn,$_POST['toolid']);
    $stock=mysqli_escape_string($conn,$_POST['stocks']);
 
    $sql="INSERT INTO stocktable (tools_id,stocks)VALUES(' $toolsid','  $stock');";
    
         if(mysqli_query($conn,$sql)==true){
     
            echo"<script>alert('Record has been saved');</script>";
            echo"<script>window.location='adminstocks.php';</script>";
           }else{
    echo"<script>alert('Exception is not valid');</script>";
  
}
}
if (isset($_GET['editstock'])) {
    $stockid=$_GET['editstock'];
    $toolid= $_GET['toolid'];
    $update=true;
    $sql="SELECT * FROM stocktable WHERE stock_id=$stockid and tools_id=$toolid;";
    $result=mysqli_query($conn,$sql);
    if(count($result)==1){
        $row=mysqli_fetch_array($result);
        $toolid=$row['tools_id'];
        $stock=$row['stocks'];
 
        
        
    }
}
if (isset($_GET['deletestock'])) {
    $stockid=$_GET['deletestock'];
$toolid= $_GET['toolid'];
    $sql="DELETE FROM stocktable WHERE stock_id= $stockid and tools_id=$toolid;";
   if( mysqli_query($conn,$sql)==true){
       $toolsql="DELETE FROM toollist WHERE   tools_id=$toolid;";
       if (mysqli_query($conn, $toolsql)==true) {
          
       
//     $_SESSION['message']="Record has been Deleted";
// $_SESSION['msg_type']="danger";
echo"<script>alert('Record has been Deleted')</script>";
header("Location:  adminstocks.php");
   }}
}
// update
if(isset($_POST['stockupdate'])){
    $stockid=$_POST['stockid'];
    $toolsid=mysqli_escape_string($conn,$_POST['toolid']);
    $stock=mysqli_escape_string($conn,$_POST['stocks']);

  
    // tools_id='$toolsid',,status='$status'
    $sql="UPDATE stocktable SET tools_id='$toolsid', stocks='$stock' WHERE stock_id=' $stockid' ;";
    if(mysqli_query($conn,$sql)){
        // $_SESSION['message']="Record has been Updated";
        // $_SESSION['msg_type']="success";
        echo"<script>alert('Record has been Updated')</script>";
        header("Location:  adminstocks.php");}
 
else{
    echo"<script>alert('Exception is not valid');</script>";
    echo"<script>window.location='adminstocks.php';</script>";
}}










?>

<html>

<head>
<title>STOCK MODULE</title>
    <link href="css/adminmain.css" rel="stylesheet">
    <link href="css/adminuser.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawsome.com/releases/v5.0.1/css/all.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/jquery-2.2.3.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
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

</style>
<body>
<?php
include 'adminheader.php';
?>
        <div class="welcome">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content" style="background-color: rgb(221, 16, 221) !important;" >
                            <h2 style="color: black;">Welcome to Stock Module</h2>
                            <p style="color: black;">See What You Always See.. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div align="center" class="search">
            <input type="text" name="search" id="search" class="search-text" placeholder="Which user details are you looking for..?">
            <div class="icon" style="color: rgb(221, 16, 221) !important;"><i class="fas fa-search"></i></div>
        </div>
        <section class="statistics">
            <div class="container-fluid">
            <div class="table-stock">
                <table id="usertable" class="table table-hover">
                <tr>
                <th>Tool ID</th>
                        <th>Tool Name</th>
                        <th >Stocks</th>
                        <!-- <th >Stock Status</th> -->
                        <th colspan="2">Action</th>
                    </tr>

                    <?php
                        $query="select toollist.*,stocktable.* from stocktable join toollist on toollist.tools_id=stocktable.tools_id;";
                        $result=mysqli_query($conn,$query);
                  
                        while($row = mysqli_fetch_array($result)):?>
                    <tr>
                    <td>
                            <?php echo $row['tools_id'];?>
                        </td>
                        <td>
                            <?php echo $row['name'];?>
                        </td>
                        <td>
                            <?php echo $row['stocks'];?>
                        </td>
                        
                        <!-- <td>
                            <?php 
                            // echo
                            //  $row['status'];
                             ?>
                        </td> -->
                        <td>
                            <a href="adminstocks.php?editstock=<?php echo $row['stock_id']; ?>&toolid=<?php echo $row['tools_id']; ?>" class="edit">Edit</a></td>
                      
                      <td>  <a href="adminstocks.php?deletestock=<?php echo $row['stock_id']; ?>&toolid=<?php echo $row['tools_id']; ?>" class="delete">Delete</a></td>






                    </tr>
                    <?php endwhile; ?>


                </table>
            </div>
                <div class="form-design">
                <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="stockid" value="<?php echo $stockid?>">
                <?php
if ($update == true):
?> 
                    <h2 style="color: #f0ad4e;text-align: center;margin-bottom: 40px;">UPDATE STOCKS</h2>
            
                   <label>Tool ID</label>
                    <div class="field">
                        <input type="text" name="toolid" placeholder="Tool id" value="<?php echo $toolid;?>">
                    </div>

                    <label>Stocks</label>
                    <div class="field">
                        <input type="text" name="stocks" placeholder="stocks" value="<?php echo $stock;?>">
                    </div>
                   
                    <!-- <label>Status</label> -->
                    <!-- <div class="field">
                        <select name="status"  value="<?php
                        //  echo $statustock;?>" selected>
                            <option value="1">Avaliable</option>
                            <option value="0">Not Avaliable</option>
                        </select>
                    </div> -->
                   

   <div class="field btn">
<div class="btn-layer"></div>
<input type="submit" value="update" name="stockupdate" id="save">
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