<?php
include 'admin_header.php';
include 'navbar.php';
?>

<div class="row">
    <div class="d-flex justify-content-center">
        <h4>Welcome to the Admin Dashboard</h4>
    </div>
    <br><br><br>
    <div class="col-md-6">
       
        <div class="form-control p-4">
    <form action="actions/add-admin.php" method="post" autocomplete="off">
        <center>
            <img src="../img/user.png" width="80" alt="">
        </center>
            <label for="">Name*</label>
            <input type="text" name="name" class="form-control" required>
    <br>
            <label for="">Email*</label>
            <input type="email" name="email" class="form-control" required>
    <br>
            <label for="">Password*</label>
            <input type="password" name="password" class="form-control" required>
    <br>
            <button type="submit" class="btn btn-primary">Authorize</button>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <tbody>
<?php 
    include "../config.php";
    $query = $dbConn->prepare("SELECT * FROM system_user ORDER BY id DESC");
    $query->execute();
    $data = $query->fetchAll();
    $count = 1;

    foreach ($data as $row):
    
?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['password'] ?></td>
                    <td>
                        <a href="actions/admin_user_del.php?id=<?= $row['id'] ?>" class="btn btn-danger" role="button"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
<?php 
    $count++;
    endforeach;
?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'admin_footer.php'; ?>