
<?php

session_start();





include_once 'phpcode/component.php';
include_once 'phpcode/connectcart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rentools</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/about-us.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="js/jquery-2.2.3.min.js"></script>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
                var href=$('#rent').attr('href');
                window.location.href=href;
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
    onload = start;

    function start() {
        var i = 1;

        function Move() {
            i = (i % 4) + 1; // 4 is the Number of image in slider
            document.getElementById('i' + i).checked = true;
        }
        setInterval(Move, 5000); //change img in 5 sec
    }
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
                            <textarea cols="30" name="suggest" placeholder="Describe your experience.."
                                required></textarea>
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
                <li><a href="rental.php" class="menu-btn" id="rent"><i class=" fas fa-toolbox"></i>Rent</a></li>
               
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
             <!-- autocomple search bar -->
             <!-- <div class="search">
                <div class="search-input">
                    <form action="" method="post">
                        <input type="text"  placeholder="Which tool are you looking for ...?"  id="search" autocomplete="off" >
                        <div class="autocom-box"> -->
                            <!-- list inserted from javascript -->
                        <!-- </div>
                   
                        <div class="icon"><i class="fas fa-search"></i></div>
                    </form>


                </div>
            </div> -->
        </div>
    </nav>



    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-2">About Us </div>
                <div class="text-3">Equipment by Categery &nbsp;<span class="typing"></span></div>
                <a href="rental.php">Rent now</a>
            </div>
        </div>
    </section>
    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">About Us</h2>
            <div class="about-content">
                <div class="column left">
                    <img src="img\shop.jpg" alt="">
                </div>
                <div class="column right">
                    <div class="text">Rentools.</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi ut voluptatum eveniet doloremque
                        autem excepturi eaque, sit laboriosam voluptatem nisi delectus. Facere explicabo hic minus
                        accusamus alias fuga nihil dolorum quae. Explicabo
                        illo unde, odio consequatur ipsam possimus veritatis, placeat, ab molestiae velit inventore
                        exercitationem consequuntur blanditiis omnis beatae. Dolor iste excepturi ratione soluta quas
                        culpa voluptatum repudiandae harum non.</p>

                </div>
            </div>
        </div>
    </section>
    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <!-- <h2 class="title">About Us</h2> -->
            <div class="about-content">
                <div class="column left-2">

                    <div class="text">Location</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi ut voluptatum eveniet doloremque
                        autem excepturi eaque, sit laboriosam voluptatem nisi delectus. Facere explicabo hic minus
                        accusamus alias fuga nihil dolorum quae. Explicabo
                        blanditiis omnis beatae. Dolor iste excepturi ratione soluta quas culpa voluptatum repudiandae
                        harum non.</p>
                </div>
                <div class="column right-2">
                    <a href="https://maps.app.goo.gle/pBbtAEL3zYa3rPaW8" target="_blank">
                        <img src="img\map.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- about description note starts here -->
    <section id="about-why">
        <div class="max-width">
            <div class="about-details">
                <h2>Why Rent ?</h2>
                <p>Tool rentals give you access to tools you may not have room in your buget to buy, are only going to
                    use once or don't want to worry about maintaining or storing. Plus,it's a chance to use
                    commerical-grade tools from top brands like Bosch,Husqvarana
                    and Metabo HPT to get the job done right.
                </p>

                <h2>Types of Tools and Equipment for Rent</h2>
                <p>
                    Whether You're working on deck or installing new kitchen cabinets,tackling lawn care or something
                    else,we'll have what you need on hand. Frompower toola like drills,sanders and saws to outdoor tools
                    like pressure washers,lawn mowers and even concrete
                    tools, checking off your to-do list has never been easier.Working on things inside ,like cleaning
                    dirty carpets or installing vinyl flooring? We have indoor tools, including floor-care equipment,tp
                    meet those needa too.
                </p>


            </div>
        </div>
    </section>
    <?php
   include 'footer.php';

?>



    <!-- javascript and jquery connection links is here -->
    <script src="js/suggestsearch.js"></script>
    <script src="js/search.js"></script>
    <script src="js/scrollnav.js"></script>
    <script src="js/onclickshow.js"></script>
    <!-- <script src="js/cartindexpopup.js"></script> -->

</body>

</html>