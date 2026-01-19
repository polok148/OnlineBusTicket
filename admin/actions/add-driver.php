<?php 


if($_SERVER['REQUEST_METHOD']=="POST"){

    include "../../config.php";

   $data =  $dbConn->prepare("INSERT INTO driver(identity,name,mobile,nid,skilled_percentage,img,status) VALUES(?,?,?,?,?,?,?)");


   $data->bindparam(1,$_POST['identity']);
   $data->bindparam(2,$_POST['name']);
   $data->bindparam(3,$_POST['mobile']);
   $data->bindparam(4,$_POST['nid']);
   $data->bindparam(5,$_POST['range']);
   $data->bindparam(7,$_POST['status']);

   $uploadDir = '../driver_img/';

   if (!is_dir($uploadDir)) {
       mkdir($uploadDir, 0777, true);
   }


    $file = $_FILES['img'];
    $originalName = $file['name']; 
    $tempPath = $file['tmp_name']; 

   
    $fileExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION)); 
    $newFileName = uniqid('driver_', true) . '.' . $fileExtension; 

    $targetFilePath = $uploadDir . $newFileName;

   $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
   $allowedTypes = ['jpg', 'jpeg', 'png'];

   if (in_array($fileType, $allowedTypes)) {
       
       if (move_uploaded_file( $tempPath, $targetFilePath)) {
            $data->bindparam(6,$newFileName);
       } else {
           echo "<p style='color: red;'>Error: Failed to upload the image.</p>";
       }
   } else {
       echo "<p style='color: red;'>Error: Only JPG, JPEG, PNG, and GIF files are allowed.</p>";
   }
}
   
   $data->execute();
   header("location:../admin_driver.php");
   exit();

   $dbConn->close();


?>