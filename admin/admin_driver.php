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
        <h1 class="modal-title fs-5" id="exampleModalLabel">ADD DRIVER</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php 
            function generateRandomIdentityNumber($length) {
                
                if ($length < 1) {
                    throw new InvalidArgumentException("Length must be greater than 0.");
                }
            
                
                $identityNumber = '';
                for ($i = 0; $i < $length; $i++) {
                    $identityNumber .= mt_rand(0, 9); 
                }
            
                return $identityNumber;
            }
            
        ?>
        <form action="actions/add-driver.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" value="<?= generateRandomIdentityNumber(7) ?>" name="identity">
            
            <input type="text"  name="name" class="form-control" placeholder="Name">
            <br>
            <input type="text"  name="mobile" class="form-control" placeholder="Mobile">
            <br>
            <input type="number"  name="nid" class="form-control" placeholder="NID">
            <br>
            <label for="" style="color:grey;">Formal Image: </label>
            <input type="file"  name="img" class="form-control">
            <br>
            <label for="" style="color:grey;">Status</label>
            <select name="status" class="form-control">
                <option disabled selected>---Choose status---</option>
                <option value="Active">Active</option>
                <option value="Rest">Rest</option>
            </select>
            <br>
            <div class="d-flex justify-content-around">
                <div>
                    <label for="" style="color:green;font-weight:bolder;">Skilled*</label>
                </div>
                <div>
                    <input type="range" name="range" class="form-range" id="rangeInput" min="0" max="100" value="20">
                </div>
                <div>
                    <span id="valueDisplay" style="color:red;font-weight:bold;"></span>%
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
                <i class="bi bi-plus-lg"> DRIVER</i>
                </button>
            </div>
            <div>
                <input style="border-radius:0px;border:1px solid grey;" type="search" class="form-control" placeholder="Search">
            </div>
        </div>
        
        <table class="table table-bordered">
            <tr>
                <th>IDENTITY</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Skill</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
            <tbody>
<?php 
    include "../config.php";
    $query = $dbConn->prepare("SELECT * FROM driver ORDER BY id DESC");
    $query->execute();
    $data = $query->fetchAll();

    foreach ($data as $row):
?>
                <tr>
                    <td>
                        <?= $row['identity'] ?>
                        <br>
                        <?php 
                            if ($row['status']=="Active"):
                        ?>
                            <img src="../img/test-drive.png" style="width:40px;" alt="">
                        <?php endif; ?>
                        <?php 
                            if ($row['status']=="Rest"):
                        ?>
                            <img src="../img/sleep.png" style="width:40px;" alt="">
                        <?php endif; ?>
                    </td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['mobile'] ?></td>
                    <?php 
                        if($row['skilled_percentage']<30):
                    ?>
                    <td><?= "<span style='color:red;font-weight:bolder;'>".$row['skilled_percentage']."%</span>" ?></td>
                    <?php 
                        endif;
                    ?>
                    <?php 
                        if($row['skilled_percentage']>30):
                    ?>
                    <td><?= "<span style='color:green;font-weight:bolder;'>".$row['skilled_percentage']."%</span>" ?></td>
                    <?php 
                        endif;
                    ?>
                    <td>
                        <img src="driver_img/<?= $row['img'] ?>" style="width:100px;height:100px;" alt="">
                    </td>
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
<script>
        const rangeInput = document.getElementById('rangeInput');
        const valueDisplay = document.getElementById('valueDisplay');

        
        rangeInput.addEventListener('input', () => {
            valueDisplay.textContent = rangeInput.value;
        });
</script>

<?php include "admin_footer.php";?>