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
      <div class="d-flex align-items-center">
          <div class="me-auto">
            
            <div class="d-inline-block align-items-center">
              
            </div>
          </div>
          
        </div>
      <section class="content">
        <div class="row">       
         <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">All Products</h4>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          
          <div class="table-responsive">
            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
              <thead>
                <tr class="text-dark">
                  <td>S No</td>
                  <td>Category</td>
                  <td>Sub Category</td>
                  <td>Product Name</td>
                  <td>MRP</td>
                  <td>SP</td>
                  <td>Points</td>
                  <td>Size/Weight</td>
                  <td>Tags</td>
                  <td>Meta Key Words</td>
                  <td>Meta Description</td>

                </tr>
              </thead>
              <tbody>
                <tr>
                  
                <td>S No</td>
                  <td>Category</td>
                  <td>Sub Category</td>
                  <td>Product Name</td>
                  <td>MRP</td>
                  <td>SP</td>
                  <td>Points</td>
                  <td>Size/Weight</td>
                  <td>Tags</td>
                  <td>Meta Key Words</td>
                  <td>Meta Description</td>
                  
                </tr>
            </tbody>
          </table>
        </div>

      </div>


    </div>
    <!-- /.row -->

  </section>
</div>
</div>
<?php include 'include/footer.php' ?>



<?php include 'include/js.php' ?>
</body>
</html>

