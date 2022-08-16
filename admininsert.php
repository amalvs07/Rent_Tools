<?php
session_start();
include_once 'db_conn.php';

if (isset($_POST['statusid'])) {
    $statustool=mysqli_escape_string($conn,$_POST['statusid']);
    $sql="SELECT status From toollist  where tools_id='$statustool';";
    $result=mysqli_query($conn,$sql);
    if(mysqli_fetch_assoc($result)==true){
    if ($new=$row['status']==0?1:0) {
        $sqli="UPDATE toollist SET status='$new' where tools_id='$statustool';";
        $resulti=mysqli_query($conn,$sql);
        if (mysqli_fetch_assoc($resulti)==true){
            echo"set";
        }
          
        }
    }
  
       
    }


















?>


<?php
// $name='';
// $price='';
// $description='';
// $image='';
// $status='';
// $update=false;
// $id=0;
// if (isset($_POST['save'])) {
//     $name=mysqli_escape_string($conn,$_POST['name']);
//     $price=mysqli_escape_string($conn,$_POST['price']);
 
//     $description=mysqli_escape_string($conn,$_POST['description']);
//     $status=mysqli_escape_string($conn,$_POST['status']);
//     // $image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
//     $image=$_FILES['image'];


//     //declaring variables
//     // $filename = $_FILES['image']['name'];
//     // $filetmpname = $_FILES['image']['tmp_name'];
//     $filename=$image['name'];
  
//     $fileerror=$image['error'];
//     $filetmp=$image['tmp_name'];
//     $fileext=explode('.',$filename);
//     $filecheck=strtolower(end($fileext));
//     $fileextstored=array('png','jpg','jpeg');
//     if ($fileerror==0) {
//          if(in_array($filecheck,$fileextstored)){
//          $destinationfile='image/'.$filename;
//           move_uploaded_file($filetmp,$destinationfile);

//         // $folder = 'dbimages/';
//          //function for saving the uploaded images in a specific folder
//         // move_uploaded_file($filetmpname, $folder.$filename);
//          $sql="INSERT INTO toollist (name,description,image,price,status)VALUES('$name',' $description','$destinationfile', '$price','$status');";
    
//          if(mysqli_query($conn,$sql)){
     
//               $_SESSION['message']="Record has been saved";
//               $_SESSION['msg_type']="success";
//                header("Location:  adminselect.php");
//            }
     

// }else{
//     echo"<script>alert('Exception is not valid');</script>";
//     echo"<script>window.location='adminselect.php';</script>";
// }}
// }
// if (isset($_GET['delete'])) {
//     $id=$_GET['delete'];
//     $sql="DELETE FROM toollist WHERE tools_id=$id;";
//    if( mysqli_query($conn,$sql)){
//     $_SESSION['message']="Record has been Deleted";
// $_SESSION['msg_type']="danger";
// header("Location:  adminselect.php");
//    }
// }
// if (isset($_GET['edit'])) {
//     $id=$_GET['edit'];
//     $update=true;
//     $sql="SELECT * FROM toollist WHERE tools_id=$id;";
//     $result=mysqli_query($conn,$sql);
//     if(count($result)==1){
//         $row=mysqli_fetch_array($result);
//         $name=$row['name'];
//         $price=$row['price'];
//         $description=$row['description'];
//         $status=$row['status'];
//         $image=$row['image'];
        
        
//     }
// }
// if(isset($_POST['update'])){
//     $id=$_POST['id'];
//     $name=mysqli_escape_string($conn,$_POST['name']);
//     $price=mysqli_escape_string($conn,$_POST['price']);
//     $description=mysqli_escape_string($conn,$_POST['description']);
//     $status=mysqli_escape_string($conn,$_POST['status']);
//     $image=$_FILES['image'];
//     $filename=$image['name'];
  
//     $fileerror=$image['error'];
//     $filetmp=$image['tmp_name'];
//     $fileext=explode('.',$filename);
//     $filecheck=strtolower(end($fileext));
//     $fileextstored=array('png','jpg','jpeg');
//     if ($fileerror==0) {
    
    
//     if(in_array($filecheck,$fileextstored)){
//       $destinationfile='image/'.$filename;
//       move_uploaded_file($filetmp,$destinationfile);
    
    
//      // $folder = 'dbimages/';
//      //function for saving the uploaded images in a specific folder
//      // move_uploaded_file($filetmpname, $folder.$filename);
//     $sql="UPDATE toollist SET name='$name', price='$price', description=' $description',image='$destinationfile',status='$status' WHERE tools_id='$id';";
//     if(mysqli_query($conn,$sql)){
//         $_SESSION['message']="Record has been Updated";
//         $_SESSION['msg_type']="success";
//         header("Location:  adminselect.php");
 
// }else{
//     echo"<script>alert('Exception is not valid');</script>";
//     echo"<script>window.location='adminselect.php';</script>";
// }}
// }}
// stocks update
// if (isset($_GET['editstock'])) {
//     $id=$_GET['editstock'];
//     $update=true;
//     $sql="SELECT * FROM stock WHERE stock_id=$id;";
//     $result=mysqli_query($conn,$sql);
//     if(count($result)==1){
//         $row=mysqli_fetch_array($result);
//         $toolid=$row['tools_id'];
//         $stock=$row['stocks'];
//         $status=$row['status'];
        
        
//     }
// }
// if (isset($_GET['deletestock'])) {
//     $id=$_GET['deletestock'];
//     $sql="DELETE FROM stock WHERE stock_id=$id;";
//    if( mysqli_query($conn,$sql)){
//     $_SESSION['message']="Record has been Deleted";
// $_SESSION['msg_type']="danger";
// header("Location:  adminselect.php");
//    }
// }






// if(isset($_POST['updatestock'])){
//     $id=$_POST['id'];
//     $toolsid=mysqli_escape_string($conn,$_POST['toolid']);
//     $stock=mysqli_escape_string($conn,$_POST['stocks']);
//     $status=mysqli_escape_string($conn,$_POST['status']);
  

//     $sql="UPDATE stock SET tools_id='$toolsid', stocks='$stock',status='$status' WHERE stock_id='$id';";
//     if(mysqli_query($conn,$sql)){
//         $_SESSION['message']="Record has been Updated";
//         $_SESSION['msg_type']="success";
//         header("Location:  adminselect.php");
 
// else{
//     echo"<script>alert('Exception is not valid');</script>";
//     echo"<script>window.location='adminselect.php';</script>";
// }}

?>