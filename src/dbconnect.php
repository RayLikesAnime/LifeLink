<?php
   
    $servername = "localhost"; 
    // $username = "tsunami"; 
    // $password = "munia2003";
    $username = "root"; 
    $password = "";
   
    $database = "Organ_Donation";
     $conn = mysqli_connect($servername, 
         $username, $password, $database);

    if(!$conn) {
        die("Error". mysqli_connect_error()); 
    } 
?>