<?php

include_once 'db_conn.php';
require_once 'admininsert.php';


$toolid='';
$stock='';
$status='';
$update=false;
$stockid=0;
if (isset($_POST['stocksave'])) {
    $toolsid=mysqli_escape_string($conn,$_POST['toolid']);
    $stock=mysqli_escape_string($conn,$_POST['stocks']);
    $status=mysqli_escape_string($conn,$_POST['status']);
    $sql="INSERT INTO stocktable (tools_id,stocks,status)VALUES(' $toolsid','  $stock','$status');";
    
         if(mysqli_query($conn,$sql)==true){
     
            echo"<script>alert('inserted sucess');</script>";
            echo"<script>window.location='adminselect.php';</script>";
           }else{
    echo"<script>alert('Exception is not valid');</script>";
  
}
}
if (isset($_GET['editstock'])) {
    $stockid=$_GET['editstock'];
    $toolid= $_GET['toolid'];
    $update=true;
    $sql="SELECT * FROM stocktable WHERE stock_id=$stockid and tools_id=$toolid;";
    $result=mysqli_query($conn,$sql);
    if(count($result)==1){
        $row=mysqli_fetch_array($result);
        $toolid=$row['tools_id'];
        $stock=$row['stocks'];
        $status=$row['status'];
        
        
    }
}
if (isset($_GET['deletestock'])) {
    $stockid=$_GET['deletestock'];
$toolid= $_GET['toolid'];
    $sql="DELETE FROM stocktable WHERE stock_id= $stockid and tools_id=$toolid;";
   if( mysqli_query($conn,$sql)){
    $_SESSION['message']="Record has been Deleted";
$_SESSION['msg_type']="danger";
header("Location:  adminselect.php");
   }
}
// update
if(isset($_POST['stockupdate'])){
    $stockid=$_POST['stockid'];
    $toolsid=mysqli_escape_string($conn,$_POST['toolid']);
    $stock=mysqli_escape_string($conn,$_POST['stocks']);
    $status=mysqli_escape_string($conn,$_POST['status']);
  
    // tools_id='$toolsid',
    $sql="UPDATE stocktable SET tools_id='$toolsid', stocks='$stock',status='$status' WHERE stock_id=' $stockid' ;";
    if(mysqli_query($conn,$sql)){
        $_SESSION['message']="Record has been Updated";
        $_SESSION['msg_type']="success";
        header("Location:  adminselect.php");}
 
else{
    echo"<script>alert('Exception is not valid');</script>";
    echo"<script>window.location='adminselect.php';</script>";
}}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> ADMIN DASHBOARD</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/adminselect.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/jquery-2.2.3.min.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
    $(document).ready(function() {
        $('i').click(function() {
            $('ul').toggleClass('ul_show');
            $('section').toggleClass('slide_image');
        });
        $('li').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
        // $('#save').click(function() {
        //     var image_name = $('#image').val();
        //     if (image_name == '') {
        //         alert("please select Image");
        //         return false;

        //     } else {
        //         var extention = $('#image').val().split('.').pop().toLowerCase();
        //         if (jQuery.inArray(extention, ['png', 'jpg', 'jpeg']) == -1) {
        //             alert('Invalid Image File');
        //             $('#image').val('');
        //             return false;
        //         }
        //     }
        // });
              /* by default hide all radio_content div elements except first element */
              $("section .radio_content").hide();
            $("section .radio_content:nth-child(1)").show();

            /* when any radio element is clicked, Get the attribute value of that clicked radio element and show the radio_content div element which matches the attribute value and hide the remaining tab content div elements */
            $(".radio_wrap").click(function() {
                var current_raido = $(this).attr("data-radio");
                $("section .radio_content").hide();
                $("." + current_raido).show();
            });
    });
    </script>
</head>


<body>
    <nav class="navbar ">
        <div class="max-widthh">
            <ul>
                <header>
                    <img src="img/90.jpeg">
                    <span>Admin</span>
                </header>
                <div class="radio_tabs">
                    <li class="active"> <label class="radio_wrap" data-radio="radio_1">
                    <input type="radio" name="sports" class="input" >
                    <span class="radio_mark">
                        Dashboard
                    </span>
                </label></li>
                    <li> <label class="radio_wrap" data-radio="radio_2">
                    <input type="radio" name="sports" class="input">
                    <span class="radio_mark">
                        User
                    </span>
                </label></li>
                    <li> <label class="radio_wrap" data-radio="radio_3">
                    <input type="radio" name="sports" class="input">
                    <span class="radio_mark">
                        Order
                    </span>
                </label></li>
                    <li> <label class="radio_wrap" data-radio="radio_4">
                    <input type="radio" name="sports" class="input">
                    <span class="radio_mark">
                        Tools
                    </span>
                </label></li>
                <li> <label class="radio_wrap" data-radio="radio_5">
                    <input type="radio" name="sports" class="input">
                    <span class="radio_mark">
                        Stocks
                    </span>
                </label></li>
                    <li> <label class="radio_wrap" data-radio="radio_6">
                    <input type="radio" name="sports" class="input">
                    <span class="radio_mark">
                        Feedback
                    </span>
                </label></li>
                    <li><a href="logout.php">Logout </a></li>
                </div>
            </ul>
            <!-- logo code -->

            <div class="logo"><a href="#">Rent<span>ools.</span></a></div>
        </div>

    </nav>

    <section>
        <i class="fas fa-bars"><span></span></i>
        <div id="dashboard" class="radio_content radio_1">
            <div class="heading">
                Dashboard
            </div>
            <div class="cards">
                <div class="card1">
                    <h2>USER </h2>
                </div>
                <div class="card2">
                    <h2>ORDER </h2>
                </div>
                <div class="card3">
                    <h2>TOOL </h2>
                </div>
                <div class="card3">
                    <h2>STOCK </h2>
                </div>
                <div class="card4">
                    <h2>FEEDBACK </h2>
                </div>
            </div>

        </div>

        <div class="radio_content radio_2" id="user">
            <h1>User Module</h1>
            <div class="table-align">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Aadar</th>
                        <th>Phone</th>
                        <th>Email</th>
                        
                    </tr>
                    <?php
                        $query="SELECT * FROM register ;";
                        $result=mysqli_query($conn,$query);
                  
                        while($row = mysqli_fetch_array($result)):?>
                    <tr>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td><?php echo $row['aadar'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['email'];?></td>
                    </tr>
             <?php endwhile;?>
                </table>
            </div>
        </div>
        <div class="radio_content radio_3" id="order">
            <h1>Order Module</h1>
            <div class="table-align">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Toolname</th>
                        <th>Reservation date</th>
                        <th>Return Date</th>
                        <th>Order Date</th>
                        <th>Pay Method</th>
                        <th>Total Amount</th>
                    </tr>
                    <?php
                        
                        // $query="SELECT ordertable,register. FROM ordertable,ordertool,register,toollist JOIN ON ordertable.order_id=ordertool.order_id  AND ordertool.tools_id=toollist.tools_d;";
                        $yyyy="select distinct register.name,ordertable.*,toollist.name as toolname from mainorder , toollist , register, ordertable where ordertable.order_id=mainorder.order_id
                        and toollist.tools_id=mainorder.tools_id and register.id=ordertable.id ;";
                        $result=mysqli_query($conn, $yyyy);
                  
                        while($row = mysqli_fetch_array($result)):?>
                            <tr>
                            <td><?php echo $row['order_id'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['toolname'];?></td>
                                <td><?php echo $row['reserv_date'];?></td>
                                <td><?php echo $row['return_date'];?></td>
                                <td><?php echo $row['date'];?></td>
                                <td><?php echo $row['paymethod'];?></td>
                                <td><?php echo $row['tamount'];?></td>
                                
                            </tr>
                     <?php endwhile;?>
               
                </table>
            </div>
        </div>


        <div class="radio_content radio_4" id="tool">
            <h1>Tool Module</h1>
            <?php
            if (isset($_SESSION['message'])):
              
            
            ?>
            <div class="alert-<?$_SESSION['msg_type'] ?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
        
        </div>
        <?php endif?>
            <div class="table-align">
                <table>
                    <tr>
                    <th>Tool ID</th>
                        <th>Tool Image</th>
                        <th>Tool Name</th>
                        <th >Tool Price</th>
                        <th>Tool Description</th>
                        <th >Tool Status</th>
                        <th colspan="2">Action</th>
                    </tr>

                    <?php
                        $query="SELECT * FROM toollist ;";
                        $result=mysqli_query($conn,$query);
                  
                        while($row = mysqli_fetch_array($result)):?>
                    <tr>
                    <td>
                            <?php echo $row['tools_id'];?>
                        </td>
                        <td>
                            <?php
echo'<img src="'.$row['image'].'"/>';

?>
                        </td>
                        <td>
                            <?php echo $row['name'];?>
                        </td>
                        <td>
                            <?php echo $row['price'];?>
                        </td>
                        <td>
                            <?php echo $row['description'];?>
                        </td>
                        <td>
                            <?php echo $row['status'];?>
                        </td>
                        <td>
                            <a href="adminselect.php?edit=<?php echo $row['tools_id']; ?>" class="edit">Edit</a></td>
                      
                      <td>  <a href="adminselect.php?delete=<?php echo $row['tools_id']; ?>" class="delete">Delete</a></td>






                    </tr>
                    <?php endwhile; ?>


                </table>
            </div>
            <div class="form-design">
                <form action="admininsert.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id?>">
                    <h2>Update Tools</h2>

                    <label>Tool Name</label>
                    <div class="field">
                        <input type="text" name="name" placeholder="Tool Name " value="<?php echo $name;?>"> 
                    </div>

                    <label>Price</label>
                    <div class="field">
                        <input type="text" name="price" placeholder="price" value="<?php echo $price;?>">
                    </div>
                    <label>Image</label>
                    <div class="field">
                        <input type="file" name="image" value="Upload" id="image"value="<?php echo $image;?>">
                    </div>
                    <label>Status</label>
                    <div class="field">
                        <select name="status" value="<?php echo $status;?>" selected>
                            <option value="1">Avaliable</option>
                            <option value="0">Not Avaliable</option>
                        </select>
                    </div>
                    <label>Description</label>
                    <div class="field">
                        <input type="text" name="description" placeholder="Description" value="<?php echo $description;?>">

                    </div>
<?php
if ($update == true):
?> 
   <div class="field btn">
<div class="btn-layer"></div>
<input type="submit" value="update" name="update" id="save">
</div>
<?php 
else:?>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Save" name="save" id="save">
                    </div>
<?php 
endif;?>
                </form>
            </div>
        </div>









        <div class="radio_content radio_5" id="stocks">
            <h1>Stock Module</h1>
            <?php
            if (isset($_SESSION['message'])):
              
            
            ?>
            <div class="alert-<?$_SESSION['msg_type'] ?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
        
        </div>
        <?php endif?>
            <div class="table-align">
                <table>
                    <tr>
                        
                        <th>Tool Name</th>
                        <th >Stocks</th>
                        <th >Stock Status</th>
                        <th colspan="2">Action</th>
                    </tr>

                    <?php
                        $query="select toollist.name,stocktable.* from stocktable join toollist on toollist.tools_id=stocktable.tools_id;";
                        $result=mysqli_query($conn,$query);
                  
                        while($row = mysqli_fetch_array($result)):?>
                    <tr>
                       
                        <td>
                            <?php echo $row['name'];?>
                        </td>
                        <td>
                            <?php echo $row['stocks'];?>
                        </td>
                        
                        <td>
                            <?php echo $row['status'];?>
                        </td>
                        <td>
                            <a href="adminselect.php?editstock=<?php echo $row['stock_id']; ?>&toolid=<?php echo $row['tools_id']; ?>" class="edit">Edit</a></td>
                      
                      <td>  <a href="adminselect.php?deletestock=<?php echo $row['stock_id']; ?>&toolid=<?php echo $row['tools_id']; ?>" class="delete">Delete</a></td>






                    </tr>
                    <?php endwhile; ?>


                </table>
            </div>
            <div class="form-design">
                <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="stockid" value="<?php echo $stockid?>">
                
                    <h2>Update Stocks</h2>

                    <label>Tool ID</label>
                    <div class="field">
                        <input type="text" name="toolid" placeholder="Tool id" value="<?php echo $toolid;?>">
                    </div>

                    <label>Stocks</label>
                    <div class="field">
                        <input type="text" name="stocks" placeholder="stocks" value="<?php echo $stock;?>">
                    </div>
                   
                    <label>Status</label>
                    <div class="field">
                        <select name="status"  value="<?php echo $statustock;?>" selected>
                            <option value="1">Avaliable</option>
                            <option value="0">Not Avaliable</option>
                        </select>
                    </div>
                   
<?php
if ($update == true):
?> 
   <div class="field btn">
<div class="btn-layer"></div>
<input type="submit" value="update" name="stockupdate" id="save">
</div>
<?php 
else:?>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Save" name="stocksave" id="save">
                    </div>
<?php 
endif;?>
                </form>
            </div>
        </div>

























        <div class="radio_content radio_6" id="feedback">
            <h1>Feedback Module</h1>
            <div class="table-align">
            <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Suggestions</th>
                        
                    </tr>
                    <?php
                        $query="SELECT * FROM feedback ;";
                        $result=mysqli_query($conn,$query);
                  
                        while($row = mysqli_fetch_array($result)):?>
                    <tr>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['suggest'];?></td>
                       
                    </tr>
             <?php endwhile;?>
                </table>
            </div>
        </div>

    </section>





</body>

</html>