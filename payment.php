
<?php include "header.php"; ?>
<style>
    .container {
  width: 600px;
  margin: auto;
  background: #fff;
  border-radius: 8px;
  box-shadow: 20px 10px 10px rgba(255, 26, 26, 0.3);
  padding: 20px;
  margin-bottom: 50px;
  margin-top: 50px;
}
.info-section {
  margin-bottom: 20px;
}
h3 {
  margin-bottom: 15px;
  color: #333;
  border-bottom: 1px solid #ddd;
  padding-bottom: 5px;
}
.info-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  font-size: 14px;
}
.info-row span {
  display: block;
}
.value {
  color: green;
  font-weight: bold;
}
.total {
  font-size: 16px;
  font-weight: bold;
  color: #000;
}
</style>

<div class="container">
    <div class="info-section">
    <h3>Journey Information</h3>
    <div class="info-row">
    <?php
    if(isset($_POST['submit'])){
        $bus_id=$_POST['bus_id'];
        $seatnumber = $_POST['seat_number'];
        $totalseat = $_POST['total'];
        $price = $_POST['price'];
        $username = $_POST['username'];
        $mobile = $_POST['mobile'];
        $gender = $_POST['gender'];
        $passenger= $_POST['pick'];
         include 'config.php';
      $sql="SELECT * FROM bus_info INNER JOIN route ON bus_info.route_id=route.r_id  WHERE id=?";
       $pdostmt=$dbConn->prepare($sql);
         $pdostmt->bindParam(1,$bus_id);
         $pdostmt->execute();
         $row=$pdostmt->fetch(PDO::FETCH_ASSOC);
    }
         ?>
        <span>Full Name</span>
        <span class="value"><?php echo  $username  ?></span>
      </div>
      <div class="info-row">
        <span>Phone</span>
        <span class="value"><?php echo  $mobile ?></span>
      </div>
      <div class="info-row">
        <span>Gender</span>
        <span class="value"><?php echo  $gender ?></span>
      </div>
      <div class="info-row">
        <span>Date</span>
        <span class="value"><?php echo $row['date'];?></span>
      </div>
      <div class="info-row">
        <span>Time</span>
        <span class="value"><?php echo $row['time']; ?></span>
      </div>
      <div class="info-row">
        <span>From</span>
        <span class="value"><?php echo $row['source'] ?></span>
      </div>
      <div class="info-row">
        <span>To</span>
        <span class="value"><?php echo $row['destination'] ?></span>
      </div>
      <div class="info-row">
        <span>Bus Name</span>
        <span class="value"><?php echo $row['bus_name']?></span>
      </div>
      <div class="info-row">
        <span>Bus Number</span>
        <span class="value"><?php echo $row['bus_no']?></span>
      </div>
      <div class="info-row">
        <span>Bus Type</span>
        <span class="value"><?php echo $row['bus_type'] ?></span>
      </div>
      <div class="info-row">
        <span>Total Seat</span>
        <span class="value"><?php echo $totalseat ?></span>
      </div>
      <div class="info-row">
        <span>Price</span>
        <span class="value"><?php echo $price ?>৳</span>
      </div>
    </div>
  <div class="info-section">
      <h3>Price Information</h3>
      <div class="info-row">
        <span>Ticket Price</span>
        <span class="value"><?php echo $price ?>৳</span>
      </div>
      <div class="info-row">
        <span>VAT</span>
        <span class="value">10.00 ৳</span>
      </div>
      <div class="info-row">
        <span>Service Charge</span>
        <span class="value"><?php echo $charge=20*$totalseat;?>৳</span>
      </div>
      <div class="info-row total">
        <span>Total</span>
        <span class="value"><?php echo $totalprice=($price+10)+$charge ?>৳</span>
      </div>
        <div class="d-flex justify-content-center">
      <a href="insert.php?status=<?php echo $row['status']?>&bus_id=<?php echo $bus_id?>&name=<?php echo $username?>&phone=<?php echo $mobile?>&gender=<?php echo $gender ?>&date=<?php echo $row['date'];?>&time=<?php echo $row['time'];?>&total_seat=<?php echo $totalseat?>&seat_number=<?php echo $seatnumber ?>&total_price=<?php echo $totalprice?>&passenger=<?php echo $passenger?>"  class="btn btn-success" style="width: 20%;">Payment</a>
     </div>
    </div>
  </div>
  
   
       