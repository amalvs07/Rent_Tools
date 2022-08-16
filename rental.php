<?php


session_start();





include_once 'phpcode/component.php';
include_once 'phpcode/connectcart.php';


// create instance of Createdb class
// $database = new CreateDb("minipro", "toollist");

if (isset($_POST['add'])){
    /// print_r($_POST['t_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "t_id");


 

        if(in_array($_POST['t_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'rental.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                't_id' => $_POST['t_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                't_id' => $_POST['t_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        // print_r($_SESSION['cart']);
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rentools</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                            <button type="submit" name="feedsend">SUBMIT FEEDBACK</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <?php
if ( isset($_SESSION['email'])&&isset($_SESSION['id'])){
?>
    <div class="feed-back">
        <button onclick="togglePopup()">FEEDBACK</button>
    </div>
    <?php }
?>
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
            <!-- autocomple search bar -->
            <div class="search">
                <div class="search-input">
                    <form action="" method="post">
                        <input type="text"  placeholder="Which tool are you looking for ...?"  id="search" autocomplete="off" >
                        <div class="autocom-box">
                            <!-- list inserted from javascript -->
                        </div>
                        <!-- <button type="submit" name="bar"><i class="fas fa-search"></i></button> -->
                        <div class="icon"><i class="fas fa-search"></i></div>
                    </form>


                </div>
            </div>
        </div>
    </nav>

    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-2">
                    Equipment
                </div>

                <div class="text-3">
                    Quality equipment, ready to go<br>
                    like&nbsp;&nbsp;&nbsp;<span class="typing"></span>
                </div>
                <a href="#tools">Rent now</a>




            </div>
    </section>

    <div class="max-width">
      
         <?php
         if(isset($_POST['search'])){ 
              
       echo" <div class=\"heading\">Searched Result</div>";
         }
        ?>
        <div class="wrappper">
            <div class="search-results">

            </div>
        </div>   
        </div>



    <div>


        <!-- caert -->
        <div class="max-width" id="tools">
            <div class="heading">ALL TOOLS ARE HERE</div>
            <div class="wrappper">

                <?php
$result=getData();
while ($row = mysqli_fetch_assoc($result))
               {
   component($row["name"],$row["price"],$row["image"],$row["description"],$row["tools_id"]);
}

?> 
            </div>
        </div>


        <div>


        <?php
   include 'footer.php';

?>



            <!-- javascript and jquery connection links is here -->
            <script src="js/suggestsearch.js"></script>
            <script src="js/search.js"></script>
            <script src="js/scrollnav.js"></script>
            <script src="js/script.js"></script>


</body>

</html>