<?php 
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_name'])) {
  header("location:index.php");
}

?>

<style>
    .nav-item{
        margin-left: 20%;
    }
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="../img/IUBAT Travel.png" alt="LOGO" style="width: 100px;">
    </a>
    <div class="vr"></div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link"  href="admin_dashboard.php"> <img src="../img/user-setting.png" style="width:40px;" alt=""> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#"><img src="../img/ticket.png" style="width:40px;" alt=""></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_bus.php"><img src="../img/bus.png" style="width:40px;" alt=""></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_route.php"><img src="../img/route.png" style="width:40px;" alt=""></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_driver.php"><img src="../img/driver.png" style="width:40px;" alt=""></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><img src="../img/team.png" style="width:40px;" alt=""></a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <a href="actions/logout.php" role="button" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
      </form>
    </div>
  </div>
</nav>