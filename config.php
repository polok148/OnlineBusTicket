<?php
$dbhost = "localhost";
$dbname = "bus_ticket";
$dbuser = 'root';
$dbpassword = '';
try {
   $dbConn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpassword);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Connection Failed: ".$e->getMessage();
}
?>

