<?php
session_start();
include_once 'db_conn.php';
include_once 'phpcode/component.php';
include_once 'phpcode/connectcart.php';
// $db = new CreateDb("minipro", "toollist");
// if (isset($_SESSION['cart'])){
//     $tool = array_column($_SESSION['cart'], 't_id');

//     $result = $db->getData();
//     while ($row = mysqli_fetch_assoc($result)){
//         foreach ($tool as $id){
//             if ($row['tools_id'] == $id){
// print_r($row['tools_id']);
//     }}
//     }}
//     if (isset($_SESSION['email'])||isset($_SESSION['id'])) {
//         print_r($_SESSION['email']);
//         print_r($_SESSION['id']);
     
//     }
    $reservdate=$_GET['reserv'];
    $returndate=$_GET['return'];
    $totalamount=$_GET['amt'];
   $userid=$_SESSION['id'];
  $days=$_GET['days'];


if (isset($_POST['btnSubmit'])) {
    $paymeth=$_POST['paymethod'];
   $sql="INSERT INTO ordertable(id,reserv_date,return_date,date,paymethod,tamount,days)
   VALUES(' $userid', ' $reservdate','$returndate',(select sysdate()),' $paymeth',' $totalamount',' $days');";
if($conn->query($sql)==TRUE){
    // echo"<script>alert(' inserted sucess');</script>";
    $y="SELECT order_id FROM ordertable WHERE id='$userid'and reserv_date=' $reservdate'and return_date=' $returndate' and tamount='$totalamount' and days='$days' and paymethod='$paymeth';";
    $results=mysqli_query($conn,$y);
    $row = mysqli_fetch_assoc($results);
    $orderid=$row['order_id'];

    if (isset($_SESSION['cart'])){
        $tool = array_column($_SESSION['cart'], 't_id');
        $result =getData();
        while ($row = mysqli_fetch_assoc($result)){
            foreach ($tool as $id){
                if ($row['tools_id'] == $id){
                    $t_id=  $row['tools_id'];
                    $s="INSERT INTO tbmainorder(order_id,tools_id)VALUES(' $orderid','$t_id');";
                    if($conn->query($s)==TRUE){
                        $stock="UPDATE stocktable SET stocks= stocks-1  where tools_id='$t_id'; ;";
                   
                        if($conn->query($stock)==TRUE){
                            $stockcheck="SELECT stocks FROM stocktable WHERE stocks= 0 AND tools_id='$t_id';";
                            $resultstock=mysqli_query($conn,$stockcheck);
                            if (mysqli_num_rows($resultstock)>0) {
                                $update="UPDATE  toollist SET status='0' WHERE tools_id='$t_id';";
                            }
                          
                            echo '<script>location.href="confirmpayment.php"</script>';
                    }
                        else{
                            echo"<script>alert('Payment failed');</script>";
                        }
                    }
        }
    }
        }
    }$_SESSION['cart']=NULL;
  
}else{
    echo"<script>alert('Something Went wrong');</script>";
}

}

?>

<html>

<head>
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/toolpayment.css" rel="stylesheet">
<title>PAYMENT </title>
</head>

<body>
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
    <form method="POST" action=""  class="creditly-card-form shopf-sear-headinfo_form">

        <!--Payment-->
        <section class="payment_w3ls py-5">
            <div class="container">
                <div class="privacy about">
                    <h5 class="head_agileinfo text-center text-capitalize pb-5">
                        PAYMENT </h5>
                        <div class="class-cart">Home /
<a href="cartpage.php" >Cart</a>
                        </div>
                    <div class="tab4">
                        <div class="pay_info">
                            <div class="row">
                                <div class="col-md-6 tab-grid">
                                    <div class="radio_content radio_1">
                                        <img class="pp-img" style="width:400px" src="img/pay2.jpg" alt="Image Alternative text" title="Image Title">
                                    </div>
                                    <div class="radio_content radio_2">
                                        <img class="pp-img" style="width:400px" src="img/cashondelivery.jpg" alt="Image Alternative text" title="Image Title">
                                    </div>

                                    <h5 class="head_agileinfo text-center text-capitalize pb-5">
                                        <span style="color: darkblue; font-family: 'Times New Roman', Times, serif;">Amount:<aside style="color: red; font-family: 'Times New Roman', Times, serif;   font-size: 30px;
    display: inline; "><?php echo"\t$"."\t". $totalamount;?> </aside></span></h5>


                                </div>
                                <div class="col-md-6">

                                    <!-- <form action="" method="post" class="creditly-card-form shopf-sear-headinfo_form"> -->
                                        <div class="radio_tabs">
                                            <label class="radio_wrap" data-radio="radio_1">
                                                <input type="radio" name="paymethod" class="input" value="1"required>
                                                <span class="radio_mark">
                                                   <b>Online Payment</b> 
                                                </span>
                                            </label>
                                            <br>
                                            <label class="radio_wrap" data-radio="radio_2">
                                                <input type="radio" name="paymethod" class="input" value="0" required>
                                                <span class="radio_mark">
                                                   <b>Cash on delivery</b> 
                                                </span>
                                            </label>
                                        </div>
                                        <section class="creditly-wrapper payf_wrapper">
                                            <div class="radio_content radio_1">
                                                <div class="credit-card-wrapper">
                                                    <div class="first-row form-group">
                                                        <div class="controls">
                                                            <label class="control-label">Card Holder </label>
                                                            <input class="billing-address-name form-control" type="text" autocomplete="off" name="name" placeholder="Username">
                                                        </div>
                                                        <div class="paymntf_card_number_grids">
                                                            <div class="fpay_card_number_grid_left">
                                                                <div class="controls">
                                                                    <label class="control-label">Card Number</label>
                                                                    <input class="number credit-card-number form-control" type="text" name="number" inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number"  title="enter Correct card number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;">
                                                                </div>
                                                            </div>
                                                            <div class="fpay_card_number_grid_right">
                                                                <div class="controls">
                                                                    <label class="control-label">CVV</label>
                                                                    <input class="security-code form-control" pattern="^[0-9]{3}"  title="enter proper cvv" type="password" name="security-code">
                                                                </div>
                                                            </div>
                                                            <div class="clear"> </div>
                                                        </div>



                                                        <label>Expiration Month</label>
                                                        <select class="number credit-card-number form-control" style="background-color:#BED0E9">
                                                                        <option value="01">January</option>
                                                                        <option value="02">February </option>
                                                                        <option value="03">March</option>
                                                                        <option value="04">April</option>
                                                                        <option value="05">May</option>
                                                                        <option value="06">June</option>
                                                                        <option value="07">July</option>
                                                                        <option value="08">August</option>
                                                                        <option value="09">September</option>
                                                                        <option value="10">October</option>
                                                                        <option value="11">November</option>
                                                                        <option value="12">December</option>
                                                                    </select>
                                                        <label>Expiration Year</label>
                                                        <select class="number credit-card-number form-control" style="background-color:#BED0E9">                                                                   
                                                                       
                                                                        
                                                                        <option value="21"> 2023</option>
                                                                        <option value="21"> 2024</option>
                                                                        <option value="21"> 2025</option>
                                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="btn btn-primary submit" type="submit" name="btnSubmit" value="Proceed Payment">
                                </div>
                                </section>

    <!-- </form> -->
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <!--//tabs-->
            </div>

            </div>
        </section>
        </form>
        <script src="js/jquery-2.2.3.min.js"></script>

        </script> -->

        <script>
            $(document).ready(function() {
                $("section .radio_content").hide();


                /* when any radio element is clicked, Get the attribute value of that clicked radio element and show the radio_content div element which matches the attribute value and hide the remaining tab content div elements */
                $(".radio_wrap").click(function() {
                    var current_raido = $(this).attr("data-radio");
                    $("form .radio_content").hide();
                    $("." + current_raido).show();
                });
            });
        </script>


        <!-- credit-card -->
        <script src="js/creditly.js"></script>
        <link rel="stylesheet" href="css/creditly.css" type="text/css" media="all" />

        <script>
            $(function() {
                var creditly = Creditly.initialize(
                    '.creditly-wrapper .expiration-month-and-year',
                    '.creditly-wrapper .credit-card-number',
                    '.creditly-wrapper .security-code',
                    '.creditly-wrapper .card-type');

                $(".creditly-card-form .submit").keyup(function(e) {
                    e.preventDefault();
                    var output = creditly.validate();
                    if (output) {
                        // Your validated credit card output
                        console.log(output);
                    }
                });
            });
        </script>

        <!-- Bootstrap core JavaScript
    ================================================== 
         Placed at the end of the document so the pages load faster 
         <script src="web/js/bootstrap.js"></script> 
         //payment -->
</body>

</html>