<?php 


if($_SERVER['REQUEST_METHOD']=="POST"){

    include "../../config.php";

   $data =  $dbConn->prepare("INSERT INTO system_user(email,name,password) VALUES(?,?,?)");

   $data->bindparam(1,$_POST['email']);
   $data->bindparam(2,$_POST['name']);
   $data->bindparam(3,$_POST['password']);

   $data->execute();
   header("location:../admin_dashboard.php");
   exit();

   $dbConn->close();
}


?>