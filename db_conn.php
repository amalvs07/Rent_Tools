<?php

$dbServername="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="minipro";
$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

if (!$conn) {
	echo "Connection failed!";
}