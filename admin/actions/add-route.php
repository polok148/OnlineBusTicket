<?php 


if($_SERVER['REQUEST_METHOD']=="POST"){

    include "../../config.php";

   $data =  $dbConn->prepare("INSERT INTO route(route_special_id,source,destination,distance,estimated_time,cost,time,date) VALUES(?,?,?,?,?,?,?,?)");

   $time = $_POST['hour'].":".$_POST['minute'].$_POST['meridian'];

   $data->bindparam(1,$_POST['special_key']);
   $data->bindparam(2,$_POST['source']);
   $data->bindparam(3,$_POST['destination']);
   $data->bindparam(4,$_POST['distance']);
   $data->bindparam(5,$_POST['estemeedTime']);
   $data->bindparam(6,$_POST['cost']);
   $data->bindparam(7,$time);
   $data->bindparam(8,$_POST['date']);

   $data->execute();
   header("location:../admin_route.php");
   exit();

   $dbConn->close();
}


?>