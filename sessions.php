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
        $query = "UPDATE tb_session SET status = '0' WHERE id = '$id'";
      }else{
        $query = "UPDATE tb_session SET status = '1' WHERE id = '$id'";
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
                            <h4 class="box-title">Enter Session Here</h4>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal form-element" method="POST" enctype="multipart/form-data">
                          <div class="box-body">

                              <div class="form-group row"> 


                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-label">Session</label>
                                    <input type="text" name="session" class="form-control" placeholder="Session"  >
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
                  $session = $_POST['session'];

                  $get_session = mysqli_query($con,"SELECT * FROM tb_session WHERE session = '$session'");
                  $count_session = mysqli_num_rows($get_session);

                  if ($count_session>0) {
                      echo "<script>
                      alert('Session Already Registered!')
                      </script>";
                  }else{
                      $insert = mysqli_query($con,"INSERT INTO tb_session(session) VALUES('$session')");
                      if ($insert) {
                        echo "<script>
                        alert('New Session Registered!')
                        </script>";
                    }
                }


            }
            ?>



        </div>

        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Sessions</h4>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          
          <div class="table-responsive">
            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
              <thead>
                <tr class="text-dark">
                  <td>S No</td>
                  <td>Session</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php  
           $i = 1;
           $all_session = mysqli_query($con,"SELECT * FROM tb_session");
           while($session = mysqli_fetch_assoc($all_session)){
            $status = $session['status'];
            ?>
            <tr>
               <td><?php echo $i ?></td>
               <td><?php  echo $session['session']; ?></td>
               <?php 
               if ($status == 0) {
                 ?>
                 <td><a href="?id=<?php echo $session['id']; ?>&status=enable">Enable</a></td>
                 <?php
               }else{ ?>
                <td><a href="?id=<?php echo $session['id']; ?>&status=disable">Disable</a></td>
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