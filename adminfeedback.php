<?php
session_start();
include_once 'db_conn.php';
?>

<html>

<head>
<title>FEEDBACK MODULE</title>
    <link href="css/adminmain.css" rel="stylesheet">
    <link href="css/adminuser.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
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
                        <div class="content" style="background-color: #5cb85c !important;">
                            <h2>Welcome to Feedback Module</h2>
                            <p>Yours suggestions for our services.. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div align="center" class="search">
            <input type="text" name="search" id="search" class="search-text" placeholder="Which feedback details are you looking for..?" >
            <div class="icon" style="color: #5cb85c !important;"><i class="fas fa-search"></i></div>
        </div>
        <section class="statistics">
            <div class="container-fluid">
            <div class="table-feedback">
                <table id="usertable" class="table table-hover ">
                <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Suggestions</th>
                        
                    </tr>
                    <?php
                        $query="SELECT * FROM feedback ;";
                        $result=mysqli_query($conn,$query);
                  
                        while($row = mysqli_fetch_array($result)):?>
                    <tr>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['suggest'];?></td>
                       
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