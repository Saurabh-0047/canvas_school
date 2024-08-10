<?php
include 'config.php';
session_start();
$is_login = isset($_SESSION['is_login']) ? $_SESSION['is_login'] : null;

if ($is_login == 'Admin') {
    $user_id = $_SESSION['id'];
} else {
    echo "<script>window.open('logout.php','_self')</script>";
}

if(isset($_GET['id']) && $_GET['id']!=''){
      $id = $_GET['id'];
      $status = $_GET['status'];
      if ($status == 'disable') {
        $query = "UPDATE tb_class SET status = '0' WHERE id = '$id'";
      }else{
        $query = "UPDATE tb_class SET status = '1' WHERE id = '$id'";
      }
      $delete = mysqli_query($con,$query);
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
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Enter Class Here</h4>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal form-element" method="POST" enctype="multipart/form-data">
                          <div class="box-body">

                              <div class="form-group row"> 


                                <div class="col-lg-4">
              <div class="form-group">
            <label class="form-label">Select Session</label>
            <select class="form-control" name="session" required>
              <option value="">Select Session</option>
              <?php
              $query = mysqli_query($con,"SELECT * FROM tb_session");
              while($row = mysqli_fetch_array($query)){ ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['session']; ?></option>
              <?php } ?>
            </select>
            </div> 
            </div>  

            <div class="col-lg-4">
              <div class="form-group">
            <label class="form-label">Select Class</label>
            <select class="form-control" name="class" required>
              <option value="">Select Class</option>
              <?php
              $query = mysqli_query($con,"SELECT * FROM tb_class");
              while($row = mysqli_fetch_array($query)){ ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
              <?php } ?>
            </select>
            </div> 
            </div>

            <div class="col-lg-4">
              <div class="form-group">
            <label class="form-label">Select Month</label>
           <select class="form-control" name="month[]" id="month" multiple>
             
    <?php
    $currentMonth = date('n');
    $currentYear = date('Y');
    $startMonth = 4; // April

    // If the current month is before April, consider the financial year to start from last year
    if ($currentMonth < $startMonth) {
        $startYear = $currentYear - 1;
    } else {
        $startYear = $currentYear;
    }

    // Display the months from April to March
    for ($i = $startMonth; $i <= 12; $i++) {
        ?>
        <option value="<?php echo $i ?>"><?php echo date('F', mktime(0, 0, 0, $i, 1))?></option>
    <?php
    }

    // Display the months from January to March for the next year
    for ($i = 1; $i < $startMonth; $i++) {
        ?>
        <option value="<?php echo $i ?>"><?php echo date('F', mktime(0, 0, 0, $i, 1)) ?></option>
    <?php
    }
    ?>
           </select>
            </div> 
            </div>



                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-danger">Cancel</button>
                      <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                  <!-- /.box-footer -->
              </form>
              <?php
              if (isset($_POST['submit'])) {
                  $class = $_POST['class'];

                  $get_class = mysqli_query($con,"SELECT * FROM tb_class WHERE class = '$class'");
                  $count_class = mysqli_num_rows($get_class);

                  if ($count_class>0) {
                      echo "<script>
                      alert('class Already Registered!')
                      </script>";
                  }else{
                      $insert = mysqli_query($con,"INSERT INTO tb_class(class) VALUES('$class')");
                      if ($insert) {
                        echo "<script>
                        alert('New class Registered!')
                        </script>";
                    }
                }


            }
            ?>



        </div>

        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Classs</h4>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          
          <div class="table-responsive">
            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
              <thead>
                <tr class="text-dark">
                  <td>S No</td>
                  <td>Class</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php  
           $i = 1;
           $all_class = mysqli_query($con,"SELECT * FROM tb_class");
           while($class = mysqli_fetch_assoc($all_class)){
            $status = $class['status'];
            ?>
            <tr>
               <td><?php echo $i ?></td>
               <td><?php  echo $class['class']; ?></td>
               <?php 
               if ($status == 0) {
                 ?>
                 <td><a href="?id=<?php echo $class['id']; ?>&status=enable">Enable</a></td>
                 <?php
               }else{ ?>
                <td><a href="?id=<?php echo $class['id']; ?>&status=disable">Disable</a></td>
               <?php }
                ?>
               
            </tr>
           <?php  $i++; } ?>
                
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