<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PAYMENT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <style>
    
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    box-sizing: border-box;
} 
/***************************nav bar codes********************/

.navbar {
    position: fixed;
    width: 96%;
    z-index: 999;
    padding: 30px 0;
    font-family: 'Ubuntu', sans-serif;
    transition: all 0.3s ease;
    justify-content: space-between;
}

.navbar.sticky {
    width: 100vw;
    max-height: 100px;
    padding: 40px 0;
    background: darkblue;
    justify-content: space-between;
}

.navbar .max-widthh {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-left: 90px;
}

.navbar .logo a {
    position: fixed;
    top: 30px;
    color: #000;
    /* color: #fff; */
    font-size: 35px;
    font-weight: 600;
    text-decoration: none;
}

.navbar .logo a span {
    color: blue;
    transition: all 0.3s ease;
}

.navbar.sticky .logo a span {
    color: #fff;
}

.navbar.sticky .logo a {
    color: #fff;
    top: 20px;
}
/******************* home section styling ***********************/

.home {
    min-height: 40px;
}

/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: 0px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}
#myDiv {
  display: none;
  text-align: center;
    margin: 120px 573px 50px 600px;
    padding: 40px;
    border-radius: 7px;
    box-shadow: 10px 10px 5px #aaaaaa;
}
/* model code */
.modal-confirm {		
	color: #636363;
	width: 325px;
	font-size: 14px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	border-bottom: none;   
	position: relative;
}
.modal-confirm h4 {
    text-align: center;
    font-weight: 800;
	font-size: 26px;
	margin: 30px 0 10px;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -5px;
}	
.modal-confirm .modal-footer {
	border: none;
  
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
}	
.modal-confirm .icon-box {
	color: #fff;		
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -70px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: dodgerblue;
	padding: 15px;
	text-align: center;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-confirm .icon-box i {
	font-size: 58px;
	position: relative;
	top: 3px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn {
    color: #fff;
    margin-top: 20px;
    padding: 10px 50px;
    border-radius: 4px;
    background: dodgerblue;
    text-decoration: none;
    transition: all 0.4s;
    line-height: normal;
    border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: rgb(58, 121, 184);
	outline: none;
}


</style>
    </head>
    <body onload="myFunction()" >
<nav class="navbar sticky">
        <div class="max-widthh">

            <!-- logo code -->

            <div class="logo"><a href="#">Rent<span>ools.</span></a></div>
            <!-- nav bar code -->

        </div>
    </nav>
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">

            </div>
        </div>
    </section>
<div id="loader"></div>
    <!-- Modal HTML -->
    <div style="display:none;" id="myDiv" class="animate-bottom">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
				</div>				
				<h4 class="modal-title w-100">Thank you For Your Booking </h4>	
			</div>
			<div class="modal-body">
				<p class="text-center">Your booking has been confirmed. Go back to home page  for detials.</p>
			</div>
			<div class="modal-footer">
				<a href="home.php" class="btn btn-success btn-block"  >OK</a>
			</div>
		</div>
	</div>
</div>     
    </body>
    <script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
function Home(){
    window.location="home.php";
}
</script>
</html>