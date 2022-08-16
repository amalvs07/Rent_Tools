<?php
session_start();

if (isset($_SESSION['count'])) {
   $page= $_SESSION['count']++;
} else {
    $_SESSION['count']=1;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rentools</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/mainpage.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <!-- jQuery -->
<script src="js/jquery-2.2.3.min.js"></script>


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
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
                        <li><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
                        <li><a href="rental.php " id="rent"><i class=" fas fa-toolbox"></i>Rent</a></li>
                        <li><a href="about-us.php"><i class="fas fa-question-circle"></i>About</a></li>
                     
                        <li><a href="loginform.php"><i class="fas fa-user-tie"></i>Login</a></li>
                        <li><a href="cartpage.php"><i class="fas fa-shopping-cart"></i>Cart<?php 
                    if (isset($_SESSION['cart'])) {
                        $count=count($_SESSION['cart']);
                        echo"<span id=\"cart_count\">$count</span>"; 
                    }else{
                        echo"<span id=\"cart_count\">0</span>";
                    }
                    
                    ?></a></li>
                     
                      
                    </ul>
                </div>
            </div>
            <!-- logo code -->

            <div class="logo"><a href="index.php">Rent<span>ools.</span></a></div>
            <!-- nav bar code -->
            <ul class="menu">
                <li><a href="index.php" class="menu-btn"><i class="fas fa-home"></i>&nbsp;Home</a></li>
                <li><a href="rental.php" class="menu-btn" id="rent"><i class=" fas fa-toolbox"></i>&nbsp;Rent</a></li>
                <li><a href="about-us.php" class="menu-btn"><i class="fas fa-question-circle"></i>&nbsp;About</a></li>
                <li>
                    <a href="loginform.php">
                        <div class="user"><i class="fas fa-user-circle"></i><span>&nbsp;Login</span></div>
                    </a>
                </li>
                <li>
                    <a href="cartpage.php">
                        <div class="cart"><i class="fas fa-shopping-cart"></i><span>&nbsp;Cart</span>
                        <?php 
                    if (isset($_SESSION['cart'])) {
                        $count=count($_SESSION['cart']);
                        echo"<span id=\"cart_count\">$count</span>"; 
                    }else{
                        echo"<span id=\"cart_count\">0</span>";
                    }
                    
                    ?></div>
                        </i>
                    </a>
                </li>
            </ul>
        <!-- autocomple search bar -->
        <!-- <div class="search">
                <div class="search-input">
                    <form action="rental.php" method="post">
                        <input type="text"  placeholder="Which tool are you looking for ...?"  id="search" autocomplete="off" >
                        <div class="autocom-box"> -->
                            <!-- list inserted from javascript -->
                        <!-- </div> -->
                        <!-- <button type="submit" name="bar"><i class="fas fa-search"></i></button> -->
                        <!-- <div class="icon"><i class="fas fa-search"></i></div>
                    </form>


                </div>
            </div> -->
        </div>
    </nav>



    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-2">Rent the right<br> equipment for a better website.</div>
                <div class="text-3">Equipment by Categery &nbsp;<span class="typing"></span></div>
                <a href="rental.php">Rent now</a>
            </div>
        </div>
    </section>

    <!-- <div class="max-width">
      
      <?php
      if(isset($_POST['search'])){ 
           
    echo" <div class=\"heading\">Searched Result</div>";
      }
     ?>
     <div class="wrappper">
         <div class="search-results">

         </div>
     </div>   
     </div> -->
    <!-- details section starts here conatins logo and span -->
    <main id="details">
        <section class="details" id="details">
            <div class="max-width">
                <div class="details-content">
                    <div class="image-icons"><img src="img\icons\nohiddencharge.png" alt="imageicons"><span>No Hidden Charges</span></div>
                    <div class="image-icons"><img src="img\icons\trusted.png" alt="imageicons"><span>Trusted Dealer</span></div>
                    <div class="image-icons"><img src="img\icons\delivery.png" alt="imageicons"><span>27x7 Support</span></div>
                    <h1>The Brightest Online Tool Rental Services</h1>
                    <p>We have simplified the tool rentals.Easy & Quick Online Booking with <br> unbeatable rates. Well working maintained tools</p>
                    <div class="image-icons "><img src="img\icons\doorstep.png" alt="large icons"><span>Door Step Delivery</span></div>
                    <div class="image-icons "><img src="img\icons\24-hours.png" alt="large icons"><span>24/7 Services</span></div>
                    <div class="image-icons "><img src="img\icons\nohiddencharge.png" alt="large icons"><span>No hidden charges</span></div>
                    <div class="image-icons "><img src="img\icons\customer-support.png" alt="large icons"><span>Good instruments</span></div>
                    <div class="image-icons "><img src="img\icons\credit-card.png" alt="large icons"><span>Online payment</span></div>
                    <div class="image-icons "><img src="img\icons\gobackarrow.png" alt="large icons"><span>Return</span></div>


                </div>
            </div>
        </section>

    </main>
    <!-- tool details section starts here with images -->
    <section class="tool">
        <div class="max-width">
            <div class="tool-content">
                <h1>All Tools are there</h1>
                <div class="tool-images">
                    <div class="tool-img">

                        <img src="img\new\powertools.jpg" alt="soory">
                        <span>power tool</span>

                    </div>
                    <div class="tool-img">

                        <img src="img\new\lawn.jpg" alt="soory">
                        <span>Lawn tools</span>

                    </div>
                    <div class="tool-img">

                        <img src="img\new\welding.jpg" alt="soory">
                        <span>Welding tools</span>

                    </div>
                    <div class="tool-img">
                        <a href="rental.php">
                            <img src="img\new\viewall.png" alt="soory">
                            <span></span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- how it works section with slide show images -->
    <div class="how-it-works" id="how">
        <h2> How it Works</h2>
        <p>All you need to do following steps</p>
        <div class="bendline"></div>
        <section class="slideimage">

            <div class="container">
                <input type="radio" id="i1" name="images" checked/>
                <input type="radio" id="i2" name="images" />
                <input type="radio" id="i3" name="images" />
                <input type="radio" id="i4" name="images" />
                <div class="slide_img" id="one">
                    <img src="img\edit\step1.jpg">
                    <label class="prev" for="i4"><span>&#x2039;</span></label>
                    <label class="next" for="i2"><span>&#x203a;</span></label>
                </div>
                <div class="slide_img" id="two">
                    <img src="img\edit\step2.jpg">
                    <label class="prev" for="i1"><span>&#x2039;</span></label>
                    <label class="next" for="i3"><span>&#x203a;</span></label>
                </div>
                <div class="slide_img" id="three">
                    <img src="img\edit\step3.jpg">
                    <label class="prev" for="i2"><span>&#x2039;</span></label>
                    <label class="next" for="i4"><span>&#x203a;</span></label>
                </div>
                <div class="slide_img" id="four">
                    <img src="img\edit\step4.jpg">

                    <label class="prev" for="i3"><span>&#x2039;</span></label>
                    <label class="next" for="i1"><span>&#x203a;</span></label>
                </div>

                <div id="nav_slide">
                    <label for="i1" class="dots" id="dot1"></label>
                    <label for="i2" class="dots" id="dot2"></label>
                    <label for="i3" class="dots" id="dot3"></label>
                    <label for="i4" class="dots" id="dot4"></label>
                </div>
            </div>
        </section>


    </div>

    <!-- about description note starts here -->
    <section id="about">
        <div class="max-width">
            <div class="about-details">
                <h2>Why Rent ?</h2>
                <p>Tool rentals give you access to tools you may not have room in your buget to buy, are only going to use once or don't want to worry about maintaining or storing. Plus,it's a chance to use commerical-grade tools from top brands like Bosch,Husqvarana
                    and Metabo HPT to get the job done right.
                </p>

                <h2>Types of Tools and Equipment for Rent</h2>
                <p>
                    Whether You're working on deck or installing new kitchen cabinets,tackling lawn care or something else,we'll have what you need on hand. Frompower toola like drills,sanders and saws to outdoor tools like pressure washers,lawn mowers and even concrete
                    tools, checking off your to-do list has never been easier.Working on things inside ,like cleaning dirty carpets or installing vinyl flooring? We have indoor tools, including floor-care equipment,tp meet those needa too.
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