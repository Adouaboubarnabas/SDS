<?php

$bdd =new  mysqli('localhost', 'root', '', 'ufr-sds');

 if (!$bdd) {
     die("Connection failed: " . mysqli_connect_error());
 }else{

     $sql = "DELETE FROM etudiants WHERE matricule = '$_GET[supid]'";
     
     if (mysqli_query($bdd, $sql)) {
       header('location:index.php');
       
       
     } else {
         echo "Error deleting record: " . mysqli_error($bdd);
     }

     mysqli_close($bdd);
 }

?>