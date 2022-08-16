<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['login'])) {
    
    
	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
 
     $uname = validate($_POST['uname']);
     $pass = validate($_POST['password']);
 
     if (empty($uname)) {
         header("Location: loginform.php?error=User Name is required");
         exit();
     }else if(empty($pass)){
         header("Location: loginform.php?error=Password is required");
         exit();
     }else{
        $q="select count(*) from login where email='$uname'";
        $s= mysqli_query($conn, $q);
        $r= mysqli_fetch_array($s);
        $sql = "SELECT * FROM register WHERE email='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);
        
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $uname && $row['password'] === $pass) {
            
           
            	$_SESSION['id'] = $row['id'];}}
        if($r[0]==0)    
        {
            echo '<script>alert("Username doesnt exist")</script>';
        }
        else
        {
            $_SESSION['email']=$uname;    
            $q="select * from login where email='$uname'";
            $s= mysqli_query($conn, $q);
            $r= mysqli_fetch_array($s);
            if($r[1]==$pass)  
            {
                if($r[3]=="1")
                { 
                    if($r[2]=="admin")  
                    {
                        echo '<script>location.href="admindashboard.php"</script>';
                    }
            
                    else if($r[2]=="customer")
                    {
                        echo '<script>location.href="home.php"</script>';
                    } 
                }
                else
                {
                    echo '<script>alert("Your account is not valid")</script>';
                }
            }
            else
            {
                echo '<script>alert("Incorrect password")</script>';
            }
        }
    }
}
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>USER LOGIN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/login.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body>
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
                        <li><a href="rental-us.php"><i class=" fas fa-toolbox"></i>Rent</a></li>
                        <li><a href="about-us.php"><i class="fas fa-question-circle"></i>About</a></li>
                        <li><a href="register.php"><i class="fas fa-user-plus"></i>SignUp</a></li>
                        <li><a href="cartpage.php"><i class="fas fa-shopping-cart"></i>Cart <?php 
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
                <li><a href="rental.php" class="menu-btn"><i class=" fas fa-toolbox"></i>&nbsp;Rent</a></li>
                <li><a href="about-us.php" class="menu-btn"><i class="fas fa-question-circle"></i>&nbsp;About</a></li>
                <li>
                    <a href="register.php">
                        <div class="user"><i class="fas fa-user-plus"></i><span>&nbsp;SignUp</span></div>
                    </a>
                </li>
                <li>
                    <a href="cartpage.php">
                        <div class="cart"><i class="fas fa-shopping-cart"></i><span>&nbsp;Cart</span> <?php 
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
        </div>
    </nav>
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <img src="img/login1.jpg" alt="login">
            </div>
        </div>
    </section>
    <div class="form-design">
        <form action="" method="post">
            <h2>LOGIN</h2>
            <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <label>User Name</label>
            <div class="field">
                <input type="text" name="uname" placeholder="Email Address">
            </div>
            <label>Password</label>
            <div class="field">
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>

            <div class="field btn">
                <div class="btn-layer"></div>
                <input type="submit" name="login"value="Login">
            </div>
            <div class="signup-link">Not a member? <a href="register.php">Signup now</a></div>
        </form>
    </div>
    <?php
   include 'footer.php';

?>

    <script src="js/scrollnav.js"></script>
</body>

</html>