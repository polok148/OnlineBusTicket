<?php
include 'admin_header.php';

?>

<div class="row justify-content-center" style="margin-top: 10%;">
  <?php 
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      include "../config.php";
    
      $query = $dbConn->prepare("SELECT * FROM system_user WHERE email=? && password=? LIMIT 1");
    
      $query->bindParam(1,$_POST['email']);
      $query->bindParam(2,$_POST['password']);
      $query->execute();
      
    
      if ($query->rowCount()!=0) {
    
        $data = $query->fetchAll();
    
        foreach ($data as $row) {
          session_start();
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['user_name'] = $row['user_name'];
          header("location:admin_dashboard.php");
        }
    
      }else{

        echo '<div  class="mt-6 alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Invalid !</strong> Credentials.. Try Again .
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

  }
      $dbConn = null;
    }

  ?>
  <div class="col-md-6 col-lg-4">
    <div class="card shadow">
      <div class="card-body">
        <h3 class="text-center mb-4">Admin Login</h3>
        <form action="" method="post">
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-envelope"></i></span>
              <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
          </div>
          <div class="mb-4">
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Enter password" required>
            </div>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
include 'admin_footer.php';
?>