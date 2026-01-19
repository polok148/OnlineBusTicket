<?php 

include "../../config.php";

$query = $dbConn->prepare("DELETE FROM system_user WHERE id=?");
$query->bindParam(1,$_GET['id']);
$query->execute();
header("location:../admin_dashboard.php");






