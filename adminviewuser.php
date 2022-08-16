<?php
session_start();
include_once 'db_conn.php';
if(isset($_GET['userid'])){
    $userid=$_GET['userid'];
}
?>

<html>

<head>
    <title>VIEW INDIVIDUAL USER</title>
    <link href="css/adminmain.css" rel="stylesheet">
    <link href="css/adminuser.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawsome.com/releases/v5.0.1/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
       
       <div class="class-cart" style="font-size: 20px;padding:20px">Dashboard /
<a href="adminorder.php" style="text-decoration: none;">Order Module</a>
                        </div>
        <section class="statistics">
            <h1 style="    text-align: center;
    color: dodgerblue;
    text-transform: uppercase;
    font-size: 50px;">User Details</h1>
            <div class="container-fluid">
            <div class="table-user">
                <table id="usertable" class="table table-hover">
                <?php  
     $query="SELECT * FROM register where id='$userid';";
     $result=mysqli_query($conn,$query);
    while($row = mysqli_fetch_array($result)):?>
    <tr>
        <th>ID</th>
        <td>:</td>
        <td><?php echo $row['id'];?></td>
    </tr>
    <tr>
        <th>Name</th>
       <td>:</td>
        <td><?php echo $row['name'];?></td>
    </tr>
    <tr>
        <th>Address</th>
       <td>:</td>
        <td><?php echo $row['address'];?></td>
    </tr>
    <tr>
        <th>Aadar</th>
       <td>:</td>
        <td><?php echo $row['aadar'];?></td>
    </tr>
    <tr>
        <th>Phone</th>
       <td>:</td>
        <td><?php echo $row['phone'];?></td>
    </tr>
    <tr>
        <th>Email</th>
       <td>:</td>
        <td><?php echo $row['email'];?></td>
    </tr>
    <?php endwhile;?>
                </table>
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