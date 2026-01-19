<?php
include 'admin_header.php';
include 'navbar.php';
?>
<div class="row">
  <!-- modal  -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ADD ROUTE</h1>
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
        <form action="actions/add-route.php" method="post" autocomplete="off">
            <input type="hidden" value="<?= generateRandomString(7) ?>" name="special_key">
            
            <input type="text"  name="source" class="form-control" placeholder="Source">
            <br>
            <input type="text"  name="destination" class="form-control" placeholder="Destination">
            <br>
            <input type="text"  name="distance" class="form-control" placeholder="Distance">
            <br>
            <input type="text"  name="estemeedTime" class="form-control" placeholder="Estimated Time">
            <br>
            <input type="number"  name="cost" class="form-control" placeholder="Cost">
            <br>
            <div class="d-flex justify-content-between">
                <div>
                    <label for="">Date*</label>
                    <input type="date"  name="date" class="form-control">
                </div>
                <div>
                    <label for="">Hour*</label>
                    <input style="width:100px;" min="1" max="12" type="number" name="hour" class="form-control">
                </div>
                <div>
                    <label for="">Minute*</label>
                    <input style="width:100px;" type="number" name="minute" min="0" class="form-control" max="59">
                </div>
                <div>
                    <label for="">Meri*</label>
                    <select name="meridian" class="form-control">
                        <option value="AM" selected>AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div>
            </div>
        
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
                <i class="bi bi-plus-lg"> Route</i>
                </button>
            </div>
            <div>
                <input style="border-radius:0px;border:1px solid grey;" type="search" class="form-control" placeholder="Search">
            </div>
        </div>
        
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Source</th>
                <th>Destiny</th>
                <th>Time</th>
                <th>Cost</th>
                <th>Action</th>
            </tr>
            <tbody>
<?php 
    include "../config.php";
    $query = $dbConn->prepare("SELECT * FROM route ORDER BY r_id DESC");
    $query->execute();
    $data = $query->fetchAll();

    foreach ($data as $row):
?>
                <tr>
                    <td><?= $row['route_special_id'] ?></td>
                    <td><?= $row['source'] ?></td>
                    <td><?= $row['destination'] ?></td>
                    <td><?= $row['time']." ".$row['date'] ?></td>
                    <td><?= $row['cost'] ?></td>
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