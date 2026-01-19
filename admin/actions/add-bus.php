<?php 


if($_SERVER['REQUEST_METHOD']=="POST"){

    include "../../config.php";

   $data =  $dbConn->prepare("INSERT INTO bus_info(bus_name,bus_no,bus_type,total_seat,route_id,driver_id,status) VALUES(?,?,?,?,?,?,?)");


   $data->bindparam(1,$_POST['bus_name']);
   $data->bindparam(2,$_POST['bus_no']);
   $data->bindparam(3,$_POST['bus_type']);
   $data->bindparam(4,$_POST['seat']);
   $data->bindparam(5,$_POST['route_id']);
   $data->bindparam(6,$_POST['driver_id']);
   $data->bindparam(7,$_POST['status']);


   $data->execute();
   $dbConn = null;
   header("location:../admin_bus.php");

}


?>