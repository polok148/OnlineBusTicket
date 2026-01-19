<?php include "header.php";
  include "config.php";
       $bus_id=$_GET['bus_id'];
        $seatnumber = $_GET['seat_number'];
        $username = $_GET['name'];
        $mobile = $_GET['phone'];
        $gender = $_GET['gender'];
        $date=$_GET['date'];
        $time=$_GET['time'];
        $total_seat = $_GET['total_seat'];
        $total_price= $_GET['total_price'];
        $passenger= $_GET['passenger'];
         $status= $_GET['status'];
        
         $query1 = "INSERT INTO users(name, phone, gender, passenger) VALUES(?, ?, ?, ?)";
         $stmt1 = $dbConn->prepare($query1);
         $stmt1->execute([$username, $mobile, $gender, $passenger]);

         $query2 = "SELECT id FROM users WHERE phone = ?";
         $stmt2 = $dbConn->prepare($query2);
         $stmt2->execute([$mobile]);
         $data = $stmt2->fetch(PDO::FETCH_ASSOC);

         $query3 = "INSERT INTO ticket_request VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
         $stmt3 = $dbConn->prepare($query3);
         $stmt3->execute([$bus_id, $total_seat, $seatnumber, $data['id'], $status, $date, $time, $total_price]);

         $query4 = "UPDATE bus_info SET total_seat = total_seat - ? WHERE id = ?";
         $stmt4 = $dbConn->prepare($query4);
         $stmt4->execute([$total_seat, $bus_id]);
          
            echo "<h2 style='text-align:center'>Thank you for buying the ticket</h2>";
            

           
        ?> 