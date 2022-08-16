
<html>
<head>
    <title>PAYMENT</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  margin: 100px 400px 50px 400px;
    padding:20px;
    background-color: #e2e1e2;
    border-radius: 7px;
    box-shadow: 10px 10px 5px #aaaaaa;
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

<div style="display:none;" id="myDiv" class="animate-bottom">
    <h2>Payment successfull!!!</h2><hr>
  <a href="home.php">Back to home</a>
</div>
<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>

</body>
</html>
