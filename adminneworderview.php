<?php

include_once 'db_conn.php';
?>

<html>

<head>
<title>ORDER MODULE</title>
    <link href="css/adminmain.css" rel="stylesheet">
    <link href="css/adminuser.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawsome.com/releases/v5.0.1/css/all.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/jquery-2.2.3.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
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
                        <div class="content" style="background-color:  #d9534f !important;">
                            <h2 style="color: black;">Welcome to Order Module</h2>
                            <p style="color: black;"> See What You Always See.. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div align="center" class="search">
            <input type="text" name="search" id="search" class="search-text" placeholder="Which order details are you looking for..?">
            <div class="icon" style="color:  #d9534f !important;"><i class="fas fa-search"></i></div>
        </div>

        <section class="statistics" style="padding: 100px 60px 100px 60px;">
            <div class="container-fluid">
            <div class="table-ordernew">
<?php
  $queryorder="SELECT distinct ordertable.order_id,register.id from tbmainorder , toollist , register, ordertable 
  where ordertable.order_id=tbmainorder.order_id
  and toollist.tools_id=tbmainorder.tools_id and register.id=ordertable.id order by tbmainorder.order_id desc ;";
  $resultorder=mysqli_query($conn, $queryorder);
  while ($row =mysqli_fetch_array(  $resultorder)){
    $orderid=(int)$row['order_id'];
    $userid=(int)$row['id'];
    
      ?>
 
     <table id="usertable" class="table table-hover" style="margin-bottom: 20px;">
                    <tr><th style="    width: 15%;">ID</th>
                    <!-- <th style="   width: 20%;">Username</th> -->
                        <th  style="   width: 20%;">Toolname</th>
                        <th  style="   width: 15%;">Reservation date</th>
                        <th  style="   width: 15%;">Return Date</th>
                        <th  style="   width: 15%;">Order Date</th>
                        <th  style="   width: 15%;">Pay Method</th>
                        <th style="   width: 20%;"> Amount</th>
                       
                        
                    </tr>
                    <?php
                      $total=0;
                        $query="SELECT DISTINCT register.name,ordertable.*,toollist.name AS toolname,toollist.price FROM tbmainorder , toollist , register, ordertable 
                        WHERE ordertable.order_id=tbmainorder.order_id
                        AND toollist.tools_id=tbmainorder.tools_id AND register.id=ordertable.id   AND tbmainorder.order_id='$orderid'  ;";
                        $result=mysqli_query($conn,$query);
               
                        while($row = mysqli_fetch_array($result)):?>
                <tr>
                    <td><?php echo $row['order_id'];?></td>
                    <!-- <td ><?php
                    //  echo $row['name'];?></td> -->
                                <td><?php echo $row['toolname'];?></td>
                                <td><?php echo $row['reserv_date'];?></td>
                                <td><?php echo $row['return_date'];?></td>
                                <td><?php echo $row['date'];?></td>
                                <td><?php 
                                if( (int)$row['paymethod'] ==1){
                                      echo "online payment";
                                }else{
                                    echo"cash on delivery";
                                }
                                ?></td>
                                <td><?php 
$toolbyday=(int)$row['price']*(int)$row['days'];
                                echo  $toolbyday;
                              
                                
                               
                                ?></td>
                                
                    </tr>
                    <?php
                     $total=$total+$toolbyday;
                   
                    
                    ?>
             <?php endwhile;
             ?>
             <tr>
            
                 <th colspan="2"><a href="adminviewuser.php?userid=<?php echo $userid;?>" style="     background: black;
    color: #fff;
    margin: 10px;
    padding: 5px;
    border-radius: 5px;">User Details</a></th>
                
                 <th colspan="4">Grand Total</th>
                 <th><?php  echo  $total; ?></th>
             </tr>
             <tr>
             <th colspan="2">Status</th>
             <td ><input type="checkbox" name="" id=""></td>
             <th colspan="2">Report</th>
                        
             <td colspan="2" style="background-color: green !important;">pending</td>
             </tr>
                </table>
 <?php }

?>
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
