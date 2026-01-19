<?php
include 'admin_header.php';
include 'navbar.php';
?>
<style>
    .table tr td{
        text-align: center;
    }
</style>
<div class="row">
  <!-- modal  -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ADD BUS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php 
            function generateRandomString($length) {
                
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $charactersLength = strlen($characters);
                $randomString = '';
            
               
                for ($i = 0; $i < $length; $i++) {
                    $randomIndex = rand(0, $charactersLength - 1);
                    $randomString .= $characters[$randomIndex];
                }
            
                return $randomString;
            }
        ?>
        <form action="actions/add-bus.php" method="post" autocomplete="off">
            <input type="hidden" value="<?= generateRandomString(5) ?>" name="bus_no">
            <input type="text" placeholder="Bus Name" name="bus_name" class="form-control" required>
            <br>
            <select name="bus_type" class="form-control" required>
                <option disabled selected>---Choose Type---</option>
                <option value="NON-AC">NON-AC</option>
                <option value="AC">AC</option>
            </select>
            <br>
            <input type="number"  name="seat" class="form-control" placeholder="Total Seat" required>
            <br>
<!-- choosing route -->
            <select name="route_id" class="form-control" required>
                <option selected disabled>---Choose Route---</option>
<?php 
            include "../config.php";
             $query = $dbConn->prepare("SELECT r_id,source,destination FROM route ORDER BY r_id DESC");
             $query->execute();
             $data = $query->fetchAll();
             foreach ($data as $row) :
?>
                <option value="<?= $row['r_id'] ?>"><?= $row['source']." to ".$row['destination'] ?></option>
<?php endforeach;?>
            </select>
<!-- endchoosing route -->
            <br>
<!-- choosing driver -->
            <select name="driver_id" class="form-control" required>
                <option selected disabled>---Choose Driver---</option>
<?php 
          
            $query = $dbConn->prepare("SELECT id,name,skilled_percentage FROM driver WHERE status='Active' ORDER BY id DESC");
             $query->execute();
             $data = $query->fetchAll();
             foreach ($data as $row) :
?>
                <option value="<?= $row['id'] ?>"><?= $row['name']." - ".$row['skilled_percentage']."%" ?></option>
<?php endforeach; $dbConn = null;?>
            </select>
            <br>
 <!-- END-choosing driver -->

            <select name="status" class="form-control">
                <option disabled selected>---Choose status---</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- endmodal -->

    <div style="width: 80%;margin:auto;margin-top:50px;">
        <div class="d-flex justify-content-between">
            <div>
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-lg"> BUS</i>
                </button>
            </div>
            <div>
                <input style="border-radius:0px;border:1px solid grey;" type="search" class="form-control" placeholder="Search">
            </div>
        </div>
        
        <table class="table table-bordered">
            <tr>
                <th>BUS NO</th>
                <th>Name</th>
                <th>Seat</th>
                <th>Time</th>
                <th>Route</th>
                <th>Action</th>
            </tr>
            <tbody>
<?php 
    include "../config.php";

    $query = $dbConn->prepare("SELECT bus_info.id,bus_info.bus_no,bus_info.total_seat,bus_info.bus_name,bus_info.status,route.source,route.destination,route.date,route.time FROM bus_info JOIN route WHERE route.r_id=bus_info.route_id ORDER BY bus_info.id DESC");

    $query->execute();
    $data = $query->fetchAll();

    foreach ($data as $row):
?>
                <tr>
                    <td>
                        <?= $row['bus_no'] ?>
                        <br>
                        <?php 
                            if ($row['status']=="Active"):
                        ?>
                            <img src="../img/checkmark.png" style="width:30px;" alt="">
                        <?php endif; ?>
                        <?php 
                            if ($row['status']=="Inactive"):
                        ?>
                            <img src="../img/cross.png" style="width:30px;" alt="">
                        <?php endif; ?>
                    </td>
                    <td><?= $row['bus_name'] ?></td>
                    <td><?= $row['total_seat'] ?></td>
                    <td><?= $row['time']." ".$row['date'] ?></td>
                    <td><?= $row['source']." to ".$row['destination'] ?></td>
                    <td>
                        <div class="d-flex justify-content-around">

                            <a href="#" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                            <a href="#" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                        </div>
                    </td>
                </tr>
  <?php  endforeach;  ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "admin_footer.php"; ?>