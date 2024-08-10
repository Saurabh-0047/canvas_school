<?php
  include 'config.php';
  session_start();
  $is_login = isset($_SESSION['is_login']) ? $_SESSION['is_login'] : null;

if ($is_login == 'Admin') {
    $user_id = $_SESSION['id'];
} else {
    echo "<script>window.open('logout.php','_self')</script>";
}
    ?>
<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>
<body>
<?php include 'include/header.php' ?>
<?php include 'include/sidemenu.php' ?>
<div class="content-wrapper">
    <div class="container-full">
    <div class="content-header">
      <div class="d-flex align-items-center">
        <div class="me-auto">
        </div>
      </div>
    </div>
    <section class="content">
      <div class="row">
         

  

   
      </div>
    </section>
    </div>
  </div>
<?php include 'include/footer.php' ?>



<?php include 'include/js.php' ?>
</body>
</html>
