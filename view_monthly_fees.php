<?php
include 'config.php';
session_start();
$is_login = isset($_SESSION['is_login']) ? $_SESSION['is_login'] : null;

if ($is_login == 'Admin') {
    $user_id = $_SESSION['id'];
} else {
    echo "<script>window.open('logout.php','_self')</script>";
}

 $sess_id = '';
    $show_table = 'style="display:none;"';
    $hide_form = '';

        if (isset($_GET['submit'])) {
          $sess_id = $_GET['session_id'];
          $show_table = '';
          $hide_form = 'style="display:none;"';

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
         
          
           
      <div class="col-12">
         
        <div class="box">
            
        <div class="box-header with-border">
       
          <p class="mb-0 box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</p>
         
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <form class="form-horizontal form-element" method="GET" enctype="multipart/form-data" <?php echo $hide_form; ?>>
          <div class="box-body">
           
          <div class="form-group row"> 
         

            <div class="col-lg-6">
              <div class="form-group">
            <label class="form-label">Select Session</label>
            <select class="form-control" name="session_id">
              <?php 
              $all_sessions = mysqli_query($con,"SELECT * FROM tb_session ORDER BY id DESC");
              while($sessions = mysqli_fetch_assoc($all_sessions)){
              ?>
              <option value="<?php echo $sessions['id']; ?>"><?php echo $sessions['session']; ?></option>
            <?php } ?>
            </select>
            </div> 
            </div>
          </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          <button type="submit" class="btn btn-danger">Cancel</button>
          <input type="submit" name="submit" class="btn btn-info pull-right" value="Submit">
          </div>
          <!-- /.box-footer -->
        </form>



          <div class="table-responsive" <?php echo $show_table; ?>>
            <h4>All Fees</h4>
            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
            <thead>
              <tr class="text-dark">
                <td>S.NO</td>
                <td>Class</td>
                <td>Fees For</td>
                <td>Month</td>
                <td>Fee Amount</td>
              </tr>
            </thead>
            <tbody>
           <?php  
           $i = 1;
           $all_fees = mysqli_query($con,"SELECT * FROM tb_monthly_fees WHERE sess_id = '$sess_id'");
           while($fees = mysqli_fetch_assoc($all_fees)){
            $class_id = $fees['class_id'];
            $month_id = $fees['month'];

            $month_get = mysqli_query($con,"SELECT * FROM tb_month WHERE id = '$month_id'");
            while($month = mysqli_fetch_assoc($month_get)){
              $month_name = $month['month'];
            }
            
            $class_name = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tb_class WHERE id = $class_id"));
            $class = $class_name['class'];
            ?>
            <tr>
               <td><?php echo $i ?></td>
               <td><?php  echo $class ?></td>
               <td><?php  echo $fees['fee_head']; ?></td>
               <td><?php echo $month_name; ?></td>
               <td><?php echo $fees['fee_amt']; ?></td>
                
               
            </tr>
           <?php  $i++; } ?>
          </table>
          </div>              
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
        
        
      </div>

   
      <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>
</div>
<?php include 'include/footer.php' ?>
<?php include 'include/js.php' ?>
</body>

</html>