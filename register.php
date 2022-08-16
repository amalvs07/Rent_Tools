<?php
session_start();
include_once 'db_conn.php';

if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $aadar=mysqli_real_escape_string($conn,$_POST['aadar']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $conpass=mysqli_real_escape_string($conn,$_POST['conpass']);



if (empty($name)||empty($address)||empty($phone)||empty($conpass)||empty($email)||empty($password)) {
    echo '<script>alert(" you need to fill all text")</script>';
        header("Location: register.php?SignUp=error");
     }
     else{
         $user="SELECT * FROM register where email='$email';";
         $userresult=mysqli_query($conn,$user);
         
         if(mysqli_num_rows($userresult)>0){
            echo '<script>alert("you have been already registered")</script>';
            header("Location: register.php?SignUp=already&registred");
         }else{
      
    $sql="INSERT INTO register (name,address,aadar,phone,email,password)VALUES('$name', '$address',' $aadar',' $phone','$email','$password');";
    if($conn->query($sql)==TRUE)
    {
        $sql="INSERT INTO login(email,password,usertype,status) VALUES ('$email','$password','customer','1')";
        if($conn->query($sql)==TRUE)
        {
            echo '<script>alert(" your registration successfull")</script>';
            header("Location:  loginform.php");
        }
        else
        {
            echo '<script>alert("registration failed")</script>';
            header("Location:  register.php");
        }
    }
    else
    {
        echo '<script>alert("sorry some error occured")</script>';
        header("Location:  index.php");
    }

}}
        
    
    $conn->close();
}
?>

    
  
    <!DOCTYPE html>
<html lang="en">

<head>
    <title>REGISTRATION</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="css/register.css" rel="stylesheet"> -->
    <link href="css/regisnew.css" rel="stylesheet">
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
                        <li><a href="about-us.php"><i class="fas fa-question-circle"></i>About</a></li>
                        <li><a href="rental.php"><i class=" fas fa-toolbox"></i>Rent</a></li>
                        <li><a href="loginform.php"><i class="fas fa-user-tie"></i>Login</a></li>
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
                <li>

                    <a href="logout.php">
                        <div class="user"><i class="fas fa-user-circle"></i><span>Logout</span></div>
                    </a>

                </li>
                <?php }
else{?>
                <li>
    
  <a href="loginform.php">
                        <div class="user"><i class="fas fa-user-circle"></i><span>Login</span></div>
                    </a>
                    </li>
                    <?php }?>
            
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
            </ul>

        </div>
    </nav>
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">


            </div>
        </div>
    </section>
    <div class="container">
        <div class="text">REGISTRATION</div>
        <form action="" method="post" onsubmit="return validation()">

            <div class="form-row">
                <div class="input-data">
                    <input type="text" required name="name" autocomplete="off" id="fullname">
                    <div class="underline"></div>
                    <label for="">Full Name</label>
                    <div class="error-text" id="username"></div>
                    
                </div>
                <div class="input-data">
                    <input type="text" required autocomplete="off" name="aadar" maxlength="16" id="aadharno">
                    <div class="underline"></div>
                    <label for="">Aadhar No</label>
                    <div class="error-text" id="adarno"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" required autocomplete="off" name="email" id="MailId">
                    <div class="underline"></div>
                    <label for="">Email Address</label>
                    <div class="error-text" id="email"></div>
                </div>
                <div class="input-data">
                    <input type="text" required autocomplete="off" name="phone" maxlength="10" id="phno">
                    <div class="underline"></div>
                    <label for="">Phone No</label>
                    <div class="error-text" id="phonenumber"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="password" required id="pswrd_1" autocomplete="off" name="password">
                    <div class="underline"></div>
                    <label for="">Password</label>
                    <div class="error-text" id="pass"></div>
                </div>
                <div class="input-data">
                    <input type="password" required id="pswrd_2" autocomplete="off" name="conpass">
                    <div class="underline"></div>
                    <label for="">Confirm Password</label>

                    <div class="error-text" id="confirmpass"></div>
                </div>
            </div>
            <div class="form-row">

                <div class="input-data textarea">
                    <textarea rows="8" cols="80" required autocomplete="off" name="address" id="addresses"></textarea>
                    <div class="underline"></div>
                    <label for="">Address</label>
                    <div class="error-text" id="addresss"></div>
                </div>
            </div>
            <div class="form-row submit-btn">
                <div class="input-data">
                    <div class="inner"></div>
                    <input type="submit" value="Register " id="button" name="submit">
                </div>
            </div>
            <div class="signup-link">Already a member? <a href="loginform.php">Login now</a></div>
        </form>
    </div>

    <?php
   include 'footer.php';

?>

    <script src="js/scrollnav.js"></script>
    <script type="text/javascript">
       // multiplication table
    //    const d = [
    //         [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
    //         [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
    //         [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
    //         [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
    //         [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
    //         [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
    //         [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
    //         [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
    //         [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
    //         [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
    //     ]

        // permutation table
        // const p = [
        //     [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        //     [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
        //     [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
        //     [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
        //     [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
        //     [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
        //     [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
        //     [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
        // ]
        // function aadarvalidate(aadharNumber){
        //         let c = 0
        //     let invertedArray = aadharNumber.split('').map(Number).reverse()

        //     invertedArray.forEach((val, i) => {
        //         c = d[c][p[(i % 8)][val]]
        //     })

        //     return (c === 0)
        //     }





        
        function validation(){

var user = document.getElementById('fullname').value;
var aadar=document.getElementById('aadharno').value;
var pass = document.getElementById('pswrd_1').value;
var confirmpass = document.getElementById('pswrd_2').value;
var mobileNumber = document.getElementById('phno').value;
var emails = document.getElementById('MailId').value;
var address= document.getElementById('addresses').value;

// uservalidation
if(user == ""){
    document.getElementById('username').style.display="block";
				document.getElementById('username').innerHTML ="  Please fill the username field";
				return false;
			}else{
                document.getElementById('username').style.display="none";
            }
			if((user.length <= 2) || (user.length > 20)) {
                document.getElementById('username').style.display="block";
				document.getElementById('username').innerHTML ="  Username length must be above 2 ";
				return false;	
            }
            else{
                document.getElementById('username').style.display="none";
            }
			if(!isNaN(user)){
                document.getElementById('username').style.display="block";
				document.getElementById('username').innerHTML ="  only characters are allowed";
				return false;
            }
            else{
                document.getElementById('username').style.display="none";
            }


// password validation
            if(pass == ""){
                document.getElementById('pass').style.display="block";
				document.getElementById('pass').innerHTML ="  Please fill the password field";
				return false;
			}else{
                document.getElementById('pass').style.display="none";
            }
			if((pass.length <= 5) || (pass.length > 20)) {
                document.getElementById('pass').style.display="block";
				document.getElementById('pass').innerHTML ="  Passwords length must be between 5 and 20";
				return false;	
            }
            else{
                document.getElementById('pass').style.display="none";
            }
			if(pass!=confirmpass){
                document.getElementById('confirmpass').style.display="block";
				document.getElementById('confirmpass').innerHTML ="Password does not match with confirm password";
				return false;
            }else{
                document.getElementById('confirmpass').style.display="none";
            }
            // mobile number validation
            if(mobileNumber == ""){
                document.getElementById('phonenumber').style.display="block";
				document.getElementById('phonenumber').innerHTML ="  Please fill the mobile Number field";
				return false;
			}else{
                document.getElementById('phonenumber').style.display="none";
            }
			if(isNaN(mobileNumber)){
                document.getElementById('phonenumber').style.display="block";
				document.getElementById('phonenumber').innerHTML ="   write digits only not characters";
				return false;
			}else{
                document.getElementById('phonenumber').style.display="none";
            }
			if(mobileNumber.length!=10){
                document.getElementById('phonenumber').style.display="block";
				document.getElementById('phonenumber').innerHTML ="  Mobile Number must be 10 digits only";
				return false;
            }else{
                document.getElementById('phonenumber').style.display="none";
            }
            
            // email address validation
            if(emails == ""){
                document.getElementById('email').style.display="block";
				document.getElementById('email').innerHTML ="  Please fill the email id  field";
				return false;
			}else{
                document.getElementById('email').style.display="none";
            }
			if(emails.indexOf('@') <= 0 ){
                document.getElementById('email').style.display="block";
				document.getElementById('email').innerHTML ="  @ Invalid Position";
				return false;
			}else{
                document.getElementById('email').style.display="none";
            }

			if((emails.charAt(emails.length-4)!='.') && (emails.charAt(emails.length-3)!='.')){
                document.getElementById('email').style.display="block";
				document.getElementById('email').innerHTML ="  . Invalid Position";
				return false;
            }else{
                document.getElementById('email').style.display="none";
            }
            // address validation
            if(address==""){
                document.getElementById('addresss').style.display="block";
                document.getElementById('addresss').innerHTML ="  Please fill the address  field";
				return false;
            }else{
                document.getElementById('addresss').style.display="none";
            }
            if(address.length<=7){
                document.getElementById('addresss').style.display="block";
                document.getElementById('addresss').innerHTML ="  Address  length must be  above 7 ";
				return false;
            }else{
                document.getElementById('addresss').style.display="none";
            }
            // aadhar validation
            if (aadar=="") {
                document.getElementById('adarno').style.display="block";
                document.getElementById('adarno').innerHTML ="  Please fill the Aadhar No  field";
				return false;
            }else{
                document.getElementById('adarno').style.display="none"; 
            }
            if (aadar.length = 16) {
                document.getElementById('adarno').style.display="none"; 
            }else{
               
                document.getElementById('adarno').style.display="block";
                document.getElementById('adarno').innerHTML ="  Aadhar  length must be  16";
				return false;
            }
            if (isNaN(aadar)) {
                document.getElementById('adarno').style.display="block";
                document.getElementById('adarno').innerHTML =" Your aadhar card no. not valid";
                return false;
            } else{
                document.getElementById('adarno').style.display="none"; 
            }
}
    </script>
</body>

</html>