<?php

// class CreateDb
// {
//         public $servername;
//         public $username;
//         public $password;
//         public $dbname;
//         public $tablename;
//         public $conn;


//         // class constructor
//     public function __construct(
//         $dbname = "minipro",
//         $tablename = "toollist",
//         $servername = "localhost",
//         $username = "root",
//         $password = ""
//     )
//     {
//       $this->dbname = $dbname;
//       $this->tablename = $tablename;
//       $this->servername = $servername;
//       $this->username = $username;
//       $this->password = $password;

//       // create connection
//         $this->conn = mysqli_connect($servername, $username, $password);

//         // Check connection
//         if (!$this->conn){
//             die("Connection failed : " . mysqli_connect_error());
//         }

//         // query
//         $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

//         // execute query
//         if(mysqli_query($this->conn, $sql)){

//             $this->conn = mysqli_connect($servername, $username, $password, $dbname);

//             // sql to create new table
//             $sql = " CREATE TABLE IF NOT EXISTS $tablename
//                             (tools_id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//                              name VARCHAR (30)  NULL,
//                              description	 TEXT,
//                              image          TEXT,
//                              quantity	INT(10),
//                              price INT(10)
//                             );";

//             if (!mysqli_query($this->conn, $sql)){
//                 echo "Error creating table : " . mysqli_error($this->conn);
//             }

//         }else{
//             return false;
//         }
//     }









 
//     // get product from the database
//     public function getData(){
//         $sql = "SELECT * FROM $this->tablename WHERE status='1'";

//         $result = mysqli_query($this->conn, $sql);

//         if(mysqli_num_rows($result) > 0){
//             return $result;
//         }
//     }
   
//     public function Search(){
//         $search=mysqli_escape_string($this->conn,$_POST['search']);
        
//         if (strlen($search)>1) {
//             $sql="SELECT * FROM  $this->tablename  WHERE name LIKE '%$search%';";
//             $result = mysqli_query($this->conn, $sql);


            
    
//             if(mysqli_num_rows( $result) > 0){
//                 return  $result;
//             }
//         }
        

      
//     }
// }





function getData(){
    $dbServername="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="minipro";
$ddbb=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
if (!$ddbb) {
	echo "Connection failed!";
}else{
    $sql = "SELECT * FROM toollist WHERE status='1'";

    $result = mysqli_query($ddbb, $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }}
}

 function Search(){
    $dbServername="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbName="minipro";
    $ddbb=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
    if (!$ddbb) {
        echo "Connection failed!";
    }else{
    $search=mysqli_escape_string( $ddbb,$_POST['search']);
    
    if (strlen($search)>1) {
        $sql="SELECT * FROM  toollist  WHERE name LIKE '%$search%';";
        $result = mysqli_query( $ddbb, $sql);


        

        if(mysqli_num_rows( $result) > 0){
            return  $result;
        }}
    }
    

  
}


?>