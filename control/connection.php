<?php

$dbServer = 'localhost';
$dbUsername = 'juan';
$dbPass = '1234';
$dbName='drinks';

$conn = mysqli_connect($dbServer,$dbUsername,$dbPass,$dbName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
    
}
return $conn;