<?php
    session_start();
    
 $dbhost= 'localhost';
 $dbUsername = 'root';
 $password = "@Yuzaki0709";
 $dbName = "login_teste";

 $connection = new mysqli($dbhost, $dbUsername, $password, $dbName); 
 /*
 if ($connection -> connect_errno){
    echo "deu ruim";
 }else{
    echo "deu bom";
 }
*/
?>