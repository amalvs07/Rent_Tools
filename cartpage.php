<?php
session_start();

include_once 'phpcode/component.php';
include_once 'phpcode/connectcart.php';

// $db=new CreateDb("minipro","toollist");

if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["t_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cartpage.php'</script>";
            }
        }
    }
  }

  if(isset($_POST['datediff'])){
    
      $date1=strtotime($_POST['reservation']);
      $date2=strtotime($_POST['return']);
      $nowdate=strtotime(date("Y-m-d "));
  
      
      if($date1<$date2 ){
          if( $date1 >= $nowdate || $date1==$nowdate){
            $diff= ceil(abs($date2 - $date1));
            $days=(int)floor($diff/(60*60*24));
          }
          else{
            $days=0;
            echo"<script>alert('Pick correct date ')</script>";
          }
   
      }else{
          $days=0;
          echo"<script>alert('Booking is not avaliabile in those dates')</script>";
      }
   
   }else{
     $days=null;
     $_POST['reservation']=$_POST['return']=null;

   }
  
  
  ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rentools</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/cartpage.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="js/jquery-2.2.3.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/onclickshow.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <script>
    function alertmsg() {
        alert("You have to login First");
        window.location='loginform.php';

    }
    function alertcal(){
        alert("You have to calculate amount first");
    }
    </script>
</head>

<body>
    <nav class="navbar sticky">
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
                     
                        <?php
if ( isset($_SESSION['email'])&&isset($_SESSION['id'])){
?>
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
                <?php }
else{?>
                <li>
    
  <a href="loginform.php">
                       <i class="fas fa-user-circle"></i>Login
                    </a>
                    </li>
                    <li><a href="cartpage.php"><i class="fas fa-shopping-cart"></i>Cart <?php 
                    if (isset($_SESSION['cart'])) {
                        $count=count($_SESSION['cart']);
                        echo"<span id=\"cart_count\">$count</span>"; 
                    }else{
                        echo"<span id=\"cart_count\">0</span>";
                    }
                    
                    ?></a>
                        </li>
                    <?php }?>
                       
                     
              
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
                }?>
                
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

        <div class="container-fluid">
            <div class="row px-5">
                <div class="col-md-7">
                    <div class="shopping-cart">
                        <!-- <h6 class="text-success">Opening time from 9AM -6PM</h6> -->
                        <h6>My Cart</h6>
                        <hr>

                        <?php
    $p=$days;
    $fulltotal=0;
    $total = 0;
    if (isset($_SESSION['cart'])){
        $tool = array_column($_SESSION['cart'], 't_id');
if (empty($tool )) {
    echo"<script>alert('Cart is empty')</script>";
        echo"<script>window.location='rental.php'</script>";
}
        $result =getData();
        while ($row = mysqli_fetch_assoc($result)){
            foreach ($tool as $id){
                if ($row['tools_id'] == $id){
                   cartElement( $row['name'],$row['price'],$row['image'], $row['tools_id']); 
                    $total = $total + (int)$row['price'];
                    $fulltotal=$fulltotal+((int)$row['price']*$p);
                }
            }

        }
    }else{
        echo "<h5>Cart is Empty</h5>";
        echo"<script>alert('Cart is empty')</script>";
        echo"<script>window.location='rental.php'</script>";
    }

?>

                    </div>
                </div>
                <br>
                <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

                    <div class="pt-4">
                        <h6>PRICE DETAILS</h6>
                        <hr>
                        <div class="row price-details">

                            <div class="col-md-6">
                                <h6>Reservation Date</h6>
                                <h6>Return Date</h6>
                                <br>
                                <br>
                                &nbsp;
                                <?php    echo"<h6 class=\"text-danger\">Reservation Date :<br> ".$_POST['reservation']."</h6>";
    ?>

                                <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>

                                <h6>Delivery Charges</h6>

                                <hr>

                                <?php echo"  <h6>Amount Payable($days Days)</h6>";?>
                            </div>
                            <div class="col-md-6">
                                <form action="" method="post" class="cart-items">
                                    <h6><input type="date" name="reservation" id="date"
                                            value="<?php echo $_POST['reservation']?>" required></h6>
                                    <h6><input type="date" name="return" id="date" value="<?php echo $_POST['return']?>"
                                            required></h6>
                                    <h6><input type="submit" name="datediff" class="btn btn-primary"
                                            value="Calculate Amount"></h6>
                                </form>


                                <?php
echo"<h6 class=\"text-danger\"> Return Date :<br> ".$_POST['return']."</h6>";?>

                                <h6>&#8377;<?php echo $total; ?></h6>
                                <h6 class="text-success">FREE</h6>

                                <hr>
                                <h6 class="text-danger">&#8377;<?php
                            
                           
                            echo $fulltotal;
                            ?></h6>
                                <form
                                    action="toolpayment.php?amt=<?php echo $fulltotal;?>&reserv=<?php echo $_POST['reservation'];?>&return=<?php echo $_POST['return'];?>&days=<?php echo $p;?>"
                                    method="POST">
                                    <?php
                
                 if ( isset($_SESSION['email'])&&isset($_SESSION['id'])){
                     if (isset($_POST['datediff'])) {
                       
                     
                 ?>

                                    <h6> <button type="submit" name="placeorder" class="btn  btn-warning">Place
                                            Order</button></h6>
                                            <?php }
                                            else{?>
                                                <h6> <button type="button" name="placeorder" onclick="alertcal();" class="btn  btn-warning">Place
                                            Order</button></h6>
<?php
    }}
    else
    {?>
                                    <h6> <button type="button" name="placeorder" class="btn  btn-warning"
                                            onclick="alertmsg();">Place
                                            Order</button></h6>
                                         <?php
}
                                         ?>
                                </form>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>




    </section>
    <?php
   include 'footer.php';

?>


</body>

</html>