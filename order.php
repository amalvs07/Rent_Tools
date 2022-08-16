<?php
session_start();
include_once 'db_conn.php';
if(isset($_POST['cancel'])){
$ordid=$_GET['cancelingid'];
$qurrey="UPDATE ordertable SET status=0 WHERE order_id='$ordid';";

if($conn->query($qurrey)==TRUE){
    echo"<script>alert('Your Order have Cancelled Successfully...')</script>";
}

}

if ( isset($_SESSION['email'])&&isset($_SESSION['id'])) {
$userid=$_SESSION['id'];}else{
    $userid=0;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rentools</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/adminuser.css" rel="stylesheet">
    <link href="css/rental.css" rel="stylesheet">
 
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/onclickshow.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
                $.ajax({
                    url:'searchsearch.php',
                    type:'post',
                    data:{search: $(this).val()},
                    success:function(result){
                        $(".search-results").html(result);
                    }
                });
            });
        });
    </script>
    <script>
        const btn = document.querySelector("button");
        const post = document.querySelector(".post");
        const widget = document.querySelector(".star-widget");

        btn.onclick = () => {
            widget.style.display = "none";
            post.style.display = "block";

            return false;
        }

        function togglePopup() {
            document.getElementById("popup-1").classList.toggle("active");
        }
    </script>
</head>

<body>
<div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <h1>Rent<span>ools.</span></h1>
            <div class="feedstar">
                <div class="post">
                    <div class="text">Thanks for rating us!</div>

                </div>
                <p> Overall, how satisfied are you with our website?</p>
                <div class="star-widget">
                    <input type="radio" name="rate" id="rate-5">
                    <label for="rate-5" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-4">
                    <label for="rate-4" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-3">
                    <label for="rate-3" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-2">
                    <label for="rate-2" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-1">
                    <label for="rate-1" class="fas fa-star"></label>
                    <form action="feedbackform.php" method="POST">
                        <header></header>
                        <div class="field">
                            <input type="text" name="name" id="" placeholder="Your Name" required>
                        </div>
                        <div class="field">
                            <input type="text" name="email" id="" placeholder="Your E-mail" required>
                        </div>
                        <div class="textarea">
                            <textarea cols="30" name="suggest" placeholder="Describe your experience.." required></textarea>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <button type="submit" name="feedsend">SEND MESSAGE</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- <div class="feed-back">
        <button onclick="togglePopup()">FEEDBACK</button>
    </div> -->
    <nav class="navbar">
        <div class="max-widthh">
            <!-- sidebar code -->
            <div class="wrapper">
                <input type="checkbox" id="check" checked>
                <label for="check">
                    <i class="fas fa-align-left" id="btn"></i>
                    <i class="fas fa-times" id="cancel"></i>
                </label>
                <div class="sidebar">
                    <header>Menu</header>
                    <ul>
                        <li><a href="home.php"><i class="fas fa-home"></i>Home</a></li>
                        <li><a href="rental.php"><i class=" fas fa-toolbox"></i>Rent</a></li>
                        <li><a href="about-us.php"><i class="far fa-question-circle"></i>About</a></li>
                <li><a href="order.php" class="menu-btn"><i class="fas fa-calendar-check"></i>Order</a></li>
             
              

                        <li><a href="cartpage.php"><i class="fas fa-shopping-cart"></i>Cart <?php 
                    if (isset($_SESSION['cart'])) {
                        $count=count($_SESSION['cart']);
                        echo"<span id=\"cart_count\">$count</span>"; 
                    }else{
                        echo"<span id=\"cart_count\">0</span>";
                    }
                    
                    ?></a>
                        </li>
                        <li>

<a href="logout.php">
    <i class="fas fa-user-circle"></i>Logout
</a>

</li>
                     
              
                    </ul>
                </div>
            </div>
            <!-- logo code -->

            <div class="logo"><a href="home.php">Rent<span>ools.</span></a></div>
                     <!-- nav bar code -->
                     <ul class="menu">
                <li><a href="home.php" class="menu-btn"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="rental.php" class="menu-btn"><i class=" fas fa-toolbox"></i>Rent</a></li>
               
                <li><a href="about-us.php" class="menu-btn"><i class="fas fa-question-circle"></i>About</a></li>
                <?php
if ( isset($_SESSION['email'])&&isset($_SESSION['id'])){
?>
                <li><a href="order.php" class="menu-btn"><i class="fas fa-calendar-check"></i>Order</a></li>
                <?php
}
                ?>
              
                <?php
if ( isset($_SESSION['email'])&&isset($_SESSION['id'])){
?>
      <li>
                    <a href="cartpage.php">
                        <div class="cart"><i class="fas fa-shopping-cart"></i><span>Cart</span>
                            <?php 
                    if (isset($_SESSION['cart'])) {
                        $count=count($_SESSION['cart']);
                        echo"<span id=\"cart_count\">$count</span>"; 
                    }else{
                        echo"<span id=\"cart_count\">0</span>";
                    }
                    
                    ?>
                        </div>
                        </i>
                    </a>
                </li>
                <li>

                    <a href="logout.php">
                        <div class="user"><i class="fas fa-sign-out-alt"></i><span>Logout</span></div>
                    </a>

                </li>
                <?php }
else{?>
                <li>
    
  <a href="loginform.php">
                        <div class="user"><i class="fas fa-user-circle"></i><span>Login</span></div>
                    </a>
                    </li>
                    <li>
                    <a href="cartpage.php">
                        <div class="cart"><i class="fas fa-shopping-cart"></i><span>Cart</span>
                            <?php 
                    if (isset($_SESSION['cart'])) {
                        $count=count($_SESSION['cart']);
                        echo"<span id=\"cart_count\">$count</span>"; 
                    }else{
                        echo"<span id=\"cart_count\">0</span>";
                    }
                    
                    ?>
                        </div>
                        </i>
                    </a>
                </li>
                    <?php }?>
            
              
            </ul>
     
        </div>
    </nav>

    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-2">
                   Orders
                </div>

                <div class="text-3">
                    Quality equipment, ready to go<br>
                    like&nbsp;&nbsp;&nbsp;<span class="typing"></span>
                </div>
                <a href="rental.php">Rent now</a>




            </div>
    </section>
 
            <h3 style="    padding: 20px;
    text-align: center;
    font-size: 35px;    color: dodgerblue;">My Order</h3>
                        <hr style="    position: relative;
    left: 25%;
    width: 50%;">

<section class="statistics" style="padding: 100px 60px 100px 60px;">
            <div class="container-fluid">
            <div class="table-user">
<?php
  $queryorder="select distinct ordertable.order_id ,ordertable.status as orderstatus  from tbmainorder , toollist , register, ordertable 
  where ordertable.order_id=tbmainorder.order_id
  and toollist.tools_id=tbmainorder.tools_id and register.id=ordertable.id  and register.id='$userid' order by tbmainorder.order_id desc  ;";
  $resultorder=mysqli_query($conn, $queryorder);
  if (mysqli_num_rows($resultorder)==0) {
    echo"<script>alert('No order have been placed')</script>";
    echo"<script>window.location='cartpage.php';</script>";
  }
  while ($row =mysqli_fetch_array(  $resultorder)){
    $orderid=(int)$row['order_id'];
    $orderstatus=(int)$row['orderstatus'];
    
      ?>
 
     <table id="usertable" class="table table-hover" cellpadding="25%"style="margin-bottom: 20px;">
                    <tr>
                        <!-- <th style="    width: 15%;">ID</th> -->
                        
                        <th  >Toolname</th>
                        <th  >Reservation date</th>
                        <th  >Return Date</th>
                        <th  >Order Date</th>
                        <th  >Pay Method</th>
                        <th > Amount</th>
                        
                    </tr>
                    <?php
                      $total=0;
                        $query="SELECT DISTINCT ordertable.*,toollist.name AS toolname,toollist.price FROM tbmainorder , toollist , register, ordertable 
                        WHERE ordertable.order_id=tbmainorder.order_id
                        AND toollist.tools_id=tbmainorder.tools_id AND register.id=ordertable.id  AND register.id='$userid' AND tbmainorder.order_id='$orderid' ORDER BY tbmainorder.order_id DESC ;";
                        $result=mysqli_query($conn,$query);
                
                        while($row = mysqli_fetch_array($result)):?>
                <tr>
                    <!-- <td><?php 
                    // echo $row['order_id'];?></td> -->
                               
                                <td><?php echo $row['toolname'];?></td>
                                <td><?php echo $row['reserv_date'];?></td>
                                <td><?php echo $row['return_date'];?></td>
                                <td><?php echo $row['date'];?></td>
                                <td><?php 
                                if( $row['paymethod'] ==1){
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
                 <th colspan="5">Grand Total</th>
                 <th><?php  echo  $total; ?></th>
             </tr>
             <?php
             if ($orderstatus==1) {
                
             
             ?>
             <tr>
                 <th colspan="4">
                     Do you want to cancel this order?
                 </th>
                 <th colspan="2">
                     <form method="POST" action="order.php?cancelingid=<?php echo $orderid; ?>">
                     <input type="submit" name="cancel" value="Cancel" style="    background-color: crimson;
    padding: 15px 40px;
    border-radius: 10px;
    border: crimson;
    outline: none; 
    text-transform: uppercase;
    color: white;
    cursor:pointer;
    text-decoration:none;
    ">
    </form>
                 </th>
             </tr>
             <?php
             }else{
             ?>
             <tr>
                 <th colspan="7" style="background-color: crimson;
                     text-align: center;
    font-style: italic;">This Order have been Canceled </th>
             </tr>
             <?php
             }
             ?>
                </table>
 <?php }

?>
   </div>
            </div>
        </section>
           

        <?php
   include 'footer.php';

?>



</body>
</html>

















            
    <!-- javascript and jquery connection links is here -->
    <script src="js/suggestsearch.js"></script>
    <script src="js/search.js"></script>
    <script src="js/scrollnav.js"></script>
    <script src="js/onclickshow.js"></script>
    <!-- <script src="js/cartindexpopup.js"></script> -->