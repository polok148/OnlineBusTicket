<?php include "header.php"; ?>
 <section id="checking">
<div class="row">
<div class="col-md-5">
        <img src="img/bus-show.png" style="width:90%;" alt="">
    </div>
    

<?php 
if(isset($_POST["search"])){
    include "config.php";
    $source = $_POST["source"];
    $destination = $_POST["destination"];
    $pick_up = $_POST["date"];
    $sql = "SELECT * FROM bus_info INNER JOIN route ON bus_info.route_id=route.r_id WHERE source=? AND destination=? AND date=?";
    $pdostmt = $dbConn->prepare($sql);
    $pdostmt->bindParam(1, $source);
    $pdostmt->bindParam(2, $destination);
    $pdostmt->bindParam(3, $pick_up);
    $pdostmt->execute();
    
    if($pdostmt->rowCount() > 0){
        $row = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $rows){
?>
        <div class="d-flex justify-content-around ticket">
        
            <div>
                <h4 class="x">Bus Name:<?php echo $rows['bus_name'];?></h4>
                <p class="y">Bus No:<?php echo $rows['bus_no'];?></p>
                <p class="y">Bus Type:<?php echo $rows['bus_type'];?></p>
                <p>Start Point: <span class="x"> <?php echo $rows['source'];?></span> </p>
                <p>End Point: <span class="x"><?php echo $rows['destination'];?></span> </p>
            </div>
            <div class="item">
                <h6>Departure Date</h6>
                <p><?php echo $rows['date'];?></p>
            </div>
            <div class="item">
                <h6>Departure Time</h6>
                <p><?php echo $rows['time'];?></p>
            </div>
            <div class="item">
                <h6>Seat Available</h6>
                <p><?php echo $rows['total_seat'];?></p>
            </div>
            <div class="item">
                <h6>Price</h6>
                <p><?php echo $rows['cost'];?></p>
            </div>
            <div class="item">
            <a href="view_seat.php?bus_id=<?php echo $rows['id']; ?>&bus_no=<?php echo $rows['bus_no']; ?>&bus_type=<?php echo $rows['bus_type'];?>&date=<?php echo $rows['date'];?>&time=<?php echo $rows['time'];?>&from=<?php echo $rows['source'];?>&to=<?php echo $rows['destination'];?>" role="button" class="btn btn-success" id="card">View Seat</a> <br>
            <a href="#" class="text-danger" style="font-size:12px;text-decoration:none;">Cancellation Policy</a>
            </div>
        </div>
            
        </div>
  <?php 
        } 
        exit; } else {
        echo "<div class='alert alert-warning'>No records found</div>";
        exit;
    }
   
   } 

?>

   <div class="col-md-7">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-control" id="form">
            <div class="d-flex justify-content-around mb-4 mt-4">
                <div>
                    <label for="" style="color:grey;"><i class="bi bi-geo-alt"> Source* </i> </label>
                    <br>
                    <select style="width:180px;border-radius:0px;border:1px solid #77c593;" name="source" class="form-control">
                        <?php include "config.php";
                        $sql1="SELECT source FROM route";
                        $stmt=$dbConn->query($sql1);
                        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                         ?>
                      <option value="<?php echo $row['source'];?>"><?php echo $row['source'];?></option>
                        <?php }?>
                    </select>
                </div>
                <div>
                    <img src="img/ways.png" style="width: 30px;margin-top:30px;" alt="">
                </div>
                <div>
                    <label for="" style="color:grey;"><i class="bi bi-pin-map"> Destination*</i> </label>
                    <br>
                    <select style="width:180px;border-radius:0px;border:1px solid #77c593;" name="destination" class="form-control">
                    <?php include "config.php";
                        $sql1="SELECT * FROM route";
                        $stmt=$dbConn->query($sql1);
                        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $rows){
                         ?>    
                       <option value="<?php echo $rows['destination'];?>"><?php echo $rows['destination'];?> </option>
                       <?php }?>
                        </select>
                </div>
                <div>
                    <label for="date" class="form-label" style="color:grey;"><i class="bi bi-calendar"> Pick Date*</i></label>
                    <select style="width:180px;border-radius:0px;border:1px solid #77c593;" name="date" class="form-control">   
                    <?php include "config.php";
                        $sql1="SELECT * FROM route";
                        $stmt=$dbConn->query($sql1);
                        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $rows){
                         ?> 
                         <option value="<?php echo $rows['date'];?>"><?php echo $rows['date'];?></option>
                       <?php }?>
                       </select>
                </div>
                <div>
                    <input style="margin-top:25px;" type="submit" name="search" value="Search" class="btn btn-success" ><i class="bi bi-search"></i></>
                </div>
            </div>
        </form>
    </div>
</div>
 </section>

 <section id="available">
    <div class="row mt-2">
    <?php require "config.php";
         $sql="SELECT * FROM bus_info INNER JOIN route ON bus_info.route_id=route.r_id";
         $pdostmt=$dbConn->query($sql);
         $row=$pdostmt->fetchAll(PDO::FETCH_ASSOC);
         foreach($row as $rows){
           
           ?>
        <div class="d-flex justify-content-around ticket">
            <div>
                <h4 class="x">Bus Name:<?php echo $rows['bus_name'];?></h4>
                <p class="y">Bus No:<?php echo $rows['bus_no'];?></p>
                <p class="y">Bus Type:<?php echo $rows['bus_type'];?></p>
                <p>Start Point: <span class="x"> <?php echo $rows['source'];?></span> </p>
                <p>End Point: <span class="x"><?php echo $rows['destination'];?></span> </p>
            </div>
            <div class="item">
                <h6>Departure Date</h6>
                <p><?php echo $rows['date'];?></p>
            </div>
            <div class="item">
                <h6>Departure Time</h6>
                <p><?php echo $rows['time'];?></p>
            </div>
            <div class="item">
                <h6>Seat Available</h6>
                <p><?php echo $rows['total_seat'];?></p>
            </div>
            <div class="item">
                <h6>Price</h6>
                <p><?php echo $rows['cost'];?></p>
            </div>
            <div class="item">
            <a href="view_seat.php?bus_id=<?php echo $rows['id']; ?>&bus_no=<?php echo $rows['bus_no']; ?>&bus_type=<?php echo $rows['bus_type'];?>&date=<?php echo $rows['date'];?>&time=<?php echo $rows['time'];?>&from=<?php echo $rows['source'];?>&to=<?php echo $rows['destination'];?>" role="button" class="btn btn-success" id="card">View Seat</a> <br>
            <a href="#" class="text-danger" style="font-size:12px;text-decoration:none;">Cancellation Policy</a>
            </div>
        </div>
     <?php } ?>
     
  </section>
 <?php include "footer.php"; ?>
 <script>
        function showDatePicker(input) {
            input.type = 'date';
            input.min = new Date().toISOString().split('T')[0]; // Set minimum date to today
        }

        function restorePlaceholder(input) {
            if (!input.value) {
                input.type = 'text';
                input.placeholder = 'Pick a date';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>